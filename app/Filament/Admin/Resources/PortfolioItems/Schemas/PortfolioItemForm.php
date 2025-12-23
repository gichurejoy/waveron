<?php

namespace App\Filament\Admin\Resources\PortfolioItems\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PortfolioItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Project Information')
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
                        
                        Select::make('category')
                            ->required()
                            ->options([
                                'web' => 'Web Application',
                                'mobile' => 'Mobile App',
                                'ecommerce' => 'E-commerce',
                                'enterprise' => 'Enterprise Solution',
                                'design' => 'Design Project',
                                'marketing' => 'Marketing Campaign',
                            ])
                            ->searchable(),
                        
                        TextInput::make('client_name')
                            ->label('Client Name')
                            ->maxLength(255)
                            ->placeholder('Company or individual name'),
                        
                        DatePicker::make('completed_at')
                            ->label('Completion Date')
                            ->displayFormat('d/m/Y')
                            ->helperText('When the project was completed'),
                        
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
                            ->helperText('Detailed project description')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Featured Image')
                            ->image()
                            ->directory('portfolio/featured')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->helperText('Main image shown in portfolio listings. Recommended: 1200x800px')
                            ->columnSpanFull(),
                        
                        FileUpload::make('images')
                            ->label('Gallery Images')
                            ->image()
                            ->directory('portfolio/gallery')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->multiple()
                            ->maxFiles(10)
                            ->helperText('Additional images for project gallery. Max 10 images')
                            ->columnSpanFull(),
                    ]),

                Section::make('Project Details')
                    ->schema([
                        Repeater::make('technologies')
                            ->label('Technologies Used')
                            ->schema([
                                TextInput::make('technology')
                                    ->label('Technology')
                                    ->required()
                                    ->placeholder('React, Laravel, MySQL, etc.'),
                            ])
                            ->defaultItems(3)
                            ->itemLabel(fn (array $state): ?string => $state['technology'] ?? null)
                            ->collapsible()
                            ->helperText('List technologies, frameworks, and tools used')
                            ->columnSpanFull(),
                        
                        TextInput::make('url')
                            ->label('Project URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://example.com')
                            ->helperText('Link to live project or case study')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Visibility & Ordering')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Featured Project')
                            ->helperText('Show prominently on homepage and portfolio page')
                            ->default(false),
                        
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this project'),
                        
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
