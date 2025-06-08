<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SettingResource\Pages;
use App\Filament\Admin\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';

    protected static ?string $navigationGroup = 'System Configuration';

    protected static ?string $navigationLabel = 'Application Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Setting Details')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->disabled(fn ($record) => $record?->exists)
                            ->helperText('Unique identifier for this setting'),

                        Forms\Components\Select::make('group')
                            ->required()
                            ->options([
                                'general' => 'General',
                                'mail' => 'Mail Configuration',
                                'newsletter' => 'Newsletter',
                                'system' => 'System',
                            ])
                            ->default('general'),

                        Forms\Components\Select::make('type')
                            ->required()
                            ->options([
                                'string' => 'String',
                                'boolean' => 'Boolean',
                                'integer' => 'Integer',
                                'float' => 'Float',
                                'json' => 'JSON',
                            ])
                            ->default('string')
                            ->reactive(),

                        Forms\Components\Textarea::make('description')
                            ->maxLength(500)
                            ->helperText('Human-readable description of this setting'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Setting Value')
                    ->schema([
                        // Regular text input for most types
                        Forms\Components\TextInput::make('value')
                            ->label('Value')
                            ->required()
                            ->visible(fn (Forms\Get $get) => !in_array($get('type'), ['boolean', 'json']))
                            ->password(fn (Forms\Get $get) => in_array($get('key'), ['mail_password']))
                            ->maxLength(1000),

                        // Boolean toggle
                        Forms\Components\Toggle::make('value')
                            ->label('Value')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'boolean'),

                        // JSON editor
                        Forms\Components\Textarea::make('value')
                            ->label('Value (JSON)')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'json')
                            ->rows(4)
                            ->helperText('Enter valid JSON'),

                        Forms\Components\Toggle::make('is_encrypted')
                            ->label('Encrypt Value')
                            ->helperText('Enable for sensitive data like passwords')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label('Setting Key')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'mail' => 'success',
                        'newsletter' => 'info',
                        'system' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Current Value')
                    ->limit(50)
                    ->tooltip(fn ($record) => $record->value)
                    ->formatStateUsing(function ($record) {
                        if ($record->is_encrypted) {
                            return '••••••••';
                        }
                        if ($record->type === 'boolean') {
                            return $record->value ? 'Yes' : 'No';
                        }
                        return $record->value;
                    }),

                Tables\Columns\IconColumn::make('is_encrypted')
                    ->label('Encrypted')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Modified')
                    ->dateTime()
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'mail' => 'Mail Configuration',
                        'newsletter' => 'Newsletter',
                        'system' => 'System',
                    ]),

                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'string' => 'String',
                        'boolean' => 'Boolean',
                        'integer' => 'Integer',
                        'float' => 'Float',
                        'json' => 'JSON',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => !in_array($record->key, [
                        'mail_host', 'mail_port', 'mail_username', 'mail_password',
                        'mail_encryption', 'mail_from_address', 'mail_from_name'
                    ])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('group')
            ->groups([
                Tables\Grouping\Group::make('group')
                    ->label('Setting Group'),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
