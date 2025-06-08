<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SubscriberResource\Pages;
use App\Filament\Admin\Resources\SubscriberResource\RelationManagers;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Newsletter Management';

    protected static ?string $navigationLabel = 'Newsletter Subscribers';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Subscriber Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),

                        Forms\Components\TextInput::make('name')
                            ->maxLength(255),

                        Forms\Components\TextInput::make('token')
                            ->disabled()
                            ->helperText('Auto-generated unique token for unsubscribe links'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Subscription Status')
                    ->schema([
                        Forms\Components\DateTimePicker::make('subscribed_at')
                            ->label('Subscribed At')
                            ->displayFormat('d/m/Y H:i'),

                        Forms\Components\DateTimePicker::make('unsubscribed_at')
                            ->label('Unsubscribed At')
                            ->displayFormat('d/m/Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('No name provided'),

                Tables\Columns\IconColumn::make('subscription_status')
                    ->label('Status')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->isSubscribed())
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('subscribed_at')
                    ->label('Subscribed')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Never subscribed'),

                Tables\Columns\TextColumn::make('unsubscribed_at')
                    ->label('Unsubscribed')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Still subscribed'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Added')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\Filter::make('subscribed')
                    ->label('Subscribed Only')
                    ->query(fn (Builder $query): Builder => $query->subscribed()),

                Tables\Filters\Filter::make('unsubscribed')
                    ->label('Unsubscribed Only')
                    ->query(fn (Builder $query): Builder => $query->unsubscribed()),

                Tables\Filters\Filter::make('recent')
                    ->label('Recent (Last 30 days)')
                    ->query(fn (Builder $query): Builder => $query->where('created_at', '>=', now()->subDays(30))),
            ])
            ->actions([
                Tables\Actions\Action::make('subscribe')
                    ->label('Subscribe')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->isSubscribed())
                    ->action(function ($record) {
                        $record->subscribe();
                        \Filament\Notifications\Notification::make()
                            ->title('Subscriber re-subscribed successfully')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('unsubscribe')
                    ->label('Unsubscribe')
                    ->icon('heroicon-o-minus-circle')
                    ->color('danger')
                    ->visible(fn ($record) => $record->isSubscribed())
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->unsubscribe();
                        \Filament\Notifications\Notification::make()
                            ->title('Subscriber unsubscribed successfully')
                            ->success()
                            ->send();
                    }),

                Tables\Actions\Action::make('copy_unsubscribe_link')
                    ->label('Copy Unsubscribe Link')
                    ->icon('heroicon-o-link')
                    ->color('gray')
                    ->action(function ($record) {
                        $url = route('newsletter.unsubscribe', ['token' => $record->token]);
                        \Filament\Notifications\Notification::make()
                            ->title('Unsubscribe link copied')
                            ->body($url)
                            ->success()
                            ->send();
                    }),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('bulk_subscribe')
                        ->label('Subscribe Selected')
                        ->icon('heroicon-o-plus-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if (!$record->isSubscribed()) {
                                    $record->subscribe();
                                    $count++;
                                }
                            }
                            \Filament\Notifications\Notification::make()
                                ->title("$count subscribers re-subscribed successfully")
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\BulkAction::make('bulk_unsubscribe')
                        ->label('Unsubscribe Selected')
                        ->icon('heroicon-o-minus-circle')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $count = 0;
                            foreach ($records as $record) {
                                if ($record->isSubscribed()) {
                                    $record->unsubscribe();
                                    $count++;
                                }
                            }
                            \Filament\Notifications\Notification::make()
                                ->title("$count subscribers unsubscribed successfully")
                                ->success()
                                ->send();
                        }),

                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->groups([
                Tables\Grouping\Group::make('subscription_status')
                    ->label('Subscription Status')
                    ->getDescriptionFromRecordUsing(function ($record) {
                        return $record->isSubscribed() ? 'Subscribed' : 'Unsubscribed';
                    }),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscribers::route('/'),
            'create' => Pages\CreateSubscriber::route('/create'),
            'edit' => Pages\EditSubscriber::route('/{record}/edit'),
        ];
    }
}
