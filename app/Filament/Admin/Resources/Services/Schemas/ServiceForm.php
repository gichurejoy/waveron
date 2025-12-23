<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpan(2),
                        
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the title')
                            ->columnSpan(1),
                        
                        Textarea::make('short_description')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Brief summary shown in service listings')
                            ->columnSpanFull(),
                        
                        RichEditor::make('description')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'link',
                                'h1',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                            ])
                            ->helperText('Full description of the service')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Hero Section')
                    ->description('Hero section displayed at the top of the service page')
                    ->schema([
                        TextInput::make('hero.title')
                            ->label('Hero Title')
                            ->maxLength(255)
                            ->helperText('Main heading for the hero section'),
                        
                        Textarea::make('hero.subtitle')
                            ->label('Hero Subtitle')
                            ->maxLength(500)
                            ->rows(3)
                            ->helperText('Subheading or description text'),
                        
                        FileUpload::make('hero.image')
                            ->label('Hero Image')
                            ->image()
                            ->directory('services/hero')
                            ->maxSize(5120)
                            ->imageEditor()
                            ->helperText('Hero background or featured image')
                            ->columnSpanFull(),
                        
                        TextInput::make('hero.cta_text')
                            ->label('CTA Button Text')
                            ->maxLength(100)
                            ->placeholder('Get Started')
                            ->helperText('Call-to-action button text'),
                        
                        TextInput::make('hero.cta_link')
                            ->label('CTA Button Link')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('/quote')
                            ->helperText('Link for the CTA button'),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Additional Sections')
                    ->description('Custom sections with rich content')
                    ->schema([
                        Repeater::make('sections')
                            ->label('Sections')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Section Title')
                                    ->required()
                                    ->maxLength(255),
                                
                                Textarea::make('subtitle')
                                    ->label('Section Subtitle')
                                    ->maxLength(500)
                                    ->rows(2),
                                
                                RichEditor::make('content')
                                    ->label('Section Content')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'link',
                                        'h1',
                                        'h2',
                                        'h3',
                                        'bulletList',
                                        'orderedList',
                                        'blockquote',
                                    ]),
                                
                                FileUpload::make('image')
                                    ->label('Section Image')
                                    ->image()
                                    ->directory('services/sections')
                                    ->maxSize(2048)
                                    ->imageEditor(),
                                
                                Select::make('layout')
                                    ->label('Layout')
                                    ->options([
                                        'left_image' => 'Image Left, Content Right',
                                        'right_image' => 'Image Right, Content Left',
                                        'full_width' => 'Full Width',
                                        'centered' => 'Centered',
                                    ])
                                    ->default('left_image'),
                            ])
                            ->defaultItems(0)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'New Section')
                            ->collapsible()
                            ->collapsed()
                            ->helperText('Add custom sections with content and images')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('icon')
                            ->label('Icon Class')
                            ->helperText('Bootstrap icon class (e.g., bi-code-square)')
                            ->placeholder('bi-code-square'),
                        
                        FileUpload::make('image')
                            ->label('Service Image')
                            ->image()
                            ->directory('services')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->helperText('Recommended size: 800x600px'),
                    ])
                    ->columns(3),

                Section::make('Features & Technologies')
                    ->schema([
                        Repeater::make('features')
                            ->label('Features')
                            ->schema([
                                TextInput::make('feature')
                                    ->label('Feature Name')
                                    ->required()
                                    ->placeholder('Responsive design'),
                            ])
                            ->defaultItems(3)
                            ->itemLabel(fn (array $state): ?string => $state['feature'] ?? null)
                            ->collapsible()
                            ->helperText('List key features included in this service')
                            ->columnSpanFull(),
                        
                        Repeater::make('technologies')
                            ->label('Technologies')
                            ->schema([
                                TextInput::make('technology')
                                    ->label('Technology Name')
                                    ->required()
                                    ->placeholder('React, Laravel, etc.'),
                            ])
                            ->defaultItems(2)
                            ->itemLabel(fn (array $state): ?string => $state['technology'] ?? null)
                            ->collapsible()
                            ->helperText('Technologies used or supported')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Pricing Configuration')
                    ->schema([
                        TextInput::make('base_price')
                            ->label('Base Price (USD)')
                            ->numeric()
                            ->prefix('$')
                            ->helperText('Starting price for this service')
                            ->columnSpanFull(),
                        
                        TextInput::make('default_feature_count')
                            ->label('Default Feature Count')
                            ->numeric()
                            ->default(6)
                            ->helperText('Default number of features included')
                            ->columnSpan(1),
                        
                        TextInput::make('feature_base_price')
                            ->label('Feature Base Price')
                            ->numeric()
                            ->prefix('$')
                            ->helperText('Base price per feature')
                            ->columnSpan(1),
                        
                        TextInput::make('feature_price_per_additional')
                            ->label('Price per Additional Feature')
                            ->numeric()
                            ->prefix('$')
                            ->helperText('Cost for each feature beyond default count')
                            ->columnSpan(1),
                        
                        KeyValue::make('complexity_multipliers')
                            ->label('Complexity Multipliers')
                            ->keyLabel('Complexity')
                            ->valueLabel('Multiplier')
                            ->helperText('Set multipliers: basic=1.0, advanced=1.35, enterprise=1.8')
                            ->default([
                                'basic' => '1.0',
                                'advanced' => '1.35',
                                'enterprise' => '1.8',
                            ])
                            ->columnSpanFull(),
                        
                        KeyValue::make('timeline_multipliers')
                            ->label('Timeline Multipliers')
                            ->keyLabel('Timeline')
                            ->valueLabel('Multiplier')
                            ->helperText('Set multipliers: flexible=0.9, standard=1.0, rush=1.25')
                            ->default([
                                'flexible' => '0.9',
                                'standard' => '1.0',
                                'rush' => '1.25',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Visibility & Ordering')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured Service')
                            ->helperText('Show prominently on homepage')
                            ->default(false),
                        
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this service'),
                        
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(3),
            ]);
    }
}
