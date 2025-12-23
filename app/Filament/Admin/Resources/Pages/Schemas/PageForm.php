<?php

namespace App\Filament\Admin\Resources\Pages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Page Information')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                        
                        TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->helperText('URL-friendly version of the title'),
                        
                        Textarea::make('description')
                            ->maxLength(500)
                            ->helperText('Short description for SEO and previews')
                            ->columnSpanFull(),
                        
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this page'),
                        
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),

                Section::make('Hero Section')
                    ->description('The main banner section of the page')
                    ->schema([
                        TextInput::make('hero_title')
                            ->label('Hero Title')
                            ->maxLength(255)
                            ->helperText('Main headline in the hero section'),
                        
                        Textarea::make('hero_subtitle')
                            ->label('Hero Subtitle')
                            ->maxLength(500)
                            ->helperText('Supporting text under the hero title')
                            ->columnSpanFull(),
                        
                        FileUpload::make('hero_image')
                            ->label('Hero Image')
                            ->image()
                            ->directory('pages/hero')
                            ->maxSize(2048)
                            ->helperText('Recommended size: 1920x1080px')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Page Content')
                    ->schema([
                        RichEditor::make('content')
                            ->required()
                            ->columnSpanFull()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'h1',
                                'h2',
                                'h3',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'codeBlock',
                                'undo',
                                'redo',
                            ])
                            ->helperText('The main content of the page'),
                    ]),

                Section::make('SEO & Meta Data')
                    ->description('Search engine optimization settings')
                    ->schema([
                        KeyValue::make('meta_data')
                            ->label('Meta Tags')
                            ->keyLabel('Property')
                            ->valueLabel('Content')
                            ->helperText('Add meta tags for SEO (e.g., meta_title, meta_description, keywords)')
                            ->columnSpanFull(),
                    ])
                    ->collapsed(),
            ]);
    }
}