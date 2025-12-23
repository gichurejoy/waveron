<?php

namespace App\Filament\Admin\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Setting Information')
                    ->schema([
                        TextInput::make('key')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('Unique identifier (e.g., site_name, contact_email)')
                            ->formatStateUsing(fn ($record) => $record?->key)
                            ->disabled(fn ($record) => $record !== null)
                            ->columnSpan(2),
                        
                        Select::make('group')
                            ->required()
                            ->options([
                                'general' => 'General',
                                'contact' => 'Contact Information',
                                'social' => 'Social Media',
                                'seo' => 'SEO Settings',
                                'appearance' => 'Appearance',
                                'email' => 'Email Settings',
                            ])
                            ->default('general')
                            ->columnSpan(1),
                        
                        Select::make('type')
                            ->required()
                            ->options([
                                'text' => 'Text',
                                'textarea' => 'Textarea',
                                'number' => 'Number',
                                'boolean' => 'Boolean (Yes/No)',
                                'image' => 'Image',
                                'url' => 'URL',
                                'email' => 'Email',
                            ])
                            ->default('text')
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('value', null)),
                    ])
                    ->columns(3),

                Section::make('Setting Value')
                    ->schema([
                        TextInput::make('value')
                            ->label(fn ($get) => match($get('type')) {
                                'boolean' => 'Value (checked = true, unchecked = false)',
                                default => 'Value'
                            })
                            ->visible(fn ($get) => !in_array($get('type'), ['textarea', 'boolean', 'image']))
                            ->required(fn ($get) => $get('type') !== 'boolean')
                            ->maxLength(255)
                            ->helperText(fn ($get) => match($get('type')) {
                                'url' => 'Full URL including https://',
                                'email' => 'Email address',
                                'number' => 'Numeric value',
                                default => 'Setting value'
                            })
                            ->columnSpanFull(),
                        
                        Textarea::make('value')
                            ->label('Value')
                            ->visible(fn ($get) => $get('type') === 'textarea')
                            ->required()
                            ->rows(4)
                            ->helperText('Multi-line text content')
                            ->columnSpanFull(),
                        
                        Toggle::make('value')
                            ->label('Value')
                            ->visible(fn ($get) => $get('type') === 'boolean')
                            ->helperText('Toggle for yes/no settings')
                            ->columnSpanFull(),
                        
                        FileUpload::make('value')
                            ->label('Image')
                            ->image()
                            ->directory('settings')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->visible(fn ($get) => $get('type') === 'image')
                            ->helperText('Upload image for this setting')
                            ->columnSpanFull(),
                    ]),

                Section::make('Metadata')
                    ->schema([
                        TextInput::make('label')
                            ->label('Display Label')
                            ->maxLength(255)
                            ->helperText('Human-readable label for this setting'),
                        
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(2)
                            ->helperText('Description of what this setting does')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}
