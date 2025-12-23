<?php

namespace App\Filament\Admin\Resources\Features\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Feature Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Responsive web or mobile-ready UI')
                            ->columnSpan(2),
                        
                        Select::make('service_type')
                            ->required()
                            ->options([
                                'software' => 'Software Development',
                                'design' => 'Graphic Design',
                                'branding' => 'Branding',
                                'marketing' => 'Digital Marketing',
                            ])
                            ->columnSpan(1),
                        
                        Textarea::make('description')
                            ->rows(3)
                            ->maxLength(500)
                            ->helperText('Detailed description of this feature')
                            ->columnSpanFull(),
                        
                        TextInput::make('group')
                            ->label('Group')
                            ->maxLength(255)
                            ->placeholder('e.g., Core Features, Integrations')
                            ->helperText('Group related features together'),
                        
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first')
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Section::make('Settings')
                    ->schema([
                        Toggle::make('is_default')
                            ->label('Default Feature')
                            ->helperText('Include by default in new quotes')
                            ->default(false),
                        
                        Toggle::make('is_active')
                            ->label('Active')
                            ->helperText('Show in quote calculator')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}

