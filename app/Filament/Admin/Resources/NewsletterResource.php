<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NewsletterResource\Pages;
use App\Filament\Admin\Resources\NewsletterResource\RelationManagers;
use App\Models\Newsletter;
use App\Models\EmailTemplate;
use App\Models\Subscriber;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use App\Jobs\SendNewsletterJob;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'Newsletter Management';

    protected static ?string $navigationLabel = 'Newsletters';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Newsletter Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter newsletter campaign name'),
                        
                        TextInput::make('subject')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Enter email subject line'),
                    ])
                    ->columns(2),

                Section::make('Content & Template')
                    ->schema([
                        Select::make('email_template_id')
                            ->label('Email Template')
                            ->options(EmailTemplate::active()->pluck('name', 'id'))
                            ->placeholder('Select an email template (optional)')
                            ->searchable(),

                        RichEditor::make('content')
                            ->required()
                            ->placeholder('Enter newsletter content...')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ]),
                    ]),

                Section::make('Scheduling & Status')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'scheduled' => 'Scheduled',
                                'sending' => 'Sending',
                                'sent' => 'Sent',
                                'failed' => 'Failed',
                            ])
                            ->default('draft')
                            ->required(),

                        DateTimePicker::make('scheduled_at')
                            ->label('Schedule Send Time')
                            ->placeholder('Leave empty to send immediately'),
                    ])
                    ->columns(2),

                Section::make('Sending Statistics')
                    ->schema([
                        TextInput::make('total_recipients')
                            ->numeric()
                            ->default(0)
                            ->disabled(),

                        TextInput::make('sent_count')
                            ->numeric()
                            ->default(0)
                            ->disabled(),

                        TextInput::make('failed_count')
                            ->numeric()
                            ->default(0)
                            ->disabled(),
                    ])
                    ->columns(3)
                    ->visibleOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('subject')
                    ->searchable()
                    ->limit(50),

                BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'draft',
                        'warning' => 'scheduled',
                        'primary' => 'sending',
                        'success' => 'sent',
                        'danger' => 'failed',
                    ]),

                TextColumn::make('emailTemplate.name')
                    ->label('Template')
                    ->placeholder('No template'),

                TextColumn::make('total_recipients')
                    ->label('Recipients')
                    ->sortable(),

                TextColumn::make('sent_count')
                    ->label('Sent')
                    ->sortable(),

                TextColumn::make('failed_count')
                    ->label('Failed')
                    ->sortable(),

                TextColumn::make('scheduled_at')
                    ->label('Scheduled')
                    ->dateTime()
                    ->placeholder('Not scheduled'),

                TextColumn::make('sent_at')
                    ->label('Sent At')
                    ->dateTime()
                    ->placeholder('Not sent'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'scheduled' => 'Scheduled',
                        'sending' => 'Sending',
                        'sent' => 'Sent',
                        'failed' => 'Failed',
                    ]),
            ])
            ->actions([
                Action::make('preview')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (Newsletter $record): string => route('filament.admin.resources.newsletters.preview', $record)),

                Action::make('send_test')
                    ->icon('heroicon-o-paper-airplane')
                    ->color('warning')
                    ->action(function (Newsletter $record) {
                        // Test send logic would go here
                        Notification::make()
                            ->title('Test email feature coming soon!')
                            ->info()
                            ->send();
                    })
                    ->visible(fn (Newsletter $record): bool => $record->canBeSent()),

                Action::make('send_now')
                    ->icon('heroicon-o-rocket-launch')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Newsletter $record) {
                        $subscriberCount = Subscriber::active()->count();
                        
                        if ($subscriberCount === 0) {
                            Notification::make()
                                ->title('No Active Subscribers')
                                ->body('There are no active subscribers to send the newsletter to.')
                                ->warning()
                                ->send();
                            return;
                        }
                        
                        $record->update([
                            'total_recipients' => $subscriberCount,
                            'status' => 'scheduled'
                        ]);
                        
                        // Dispatch the newsletter sending job
                        SendNewsletterJob::dispatch($record);
                        
                        Notification::make()
                            ->title('Newsletter queued for sending!')
                            ->body("Newsletter will be sent to {$subscriberCount} subscribers in the background.")
                            ->success()
                            ->send();
                    })
                    ->visible(fn (Newsletter $record): bool => $record->canBeSent()),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}
