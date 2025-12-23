<?php

namespace App\Filament\Admin\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Client Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('John Doe'),
                        
                        TextInput::make('position')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('CEO, Founder, etc.')
                            ->columnSpan(2),
                        
                        TextInput::make('company')
                            ->label('Company')
                            ->maxLength(255)
                            ->placeholder('Company Name'),
                        
                        FileUpload::make('image')
                            ->label('Client Photo')
                            ->image()
                            ->directory('testimonials')
                            ->maxSize(1024)
                            ->imageEditor()
                            ->avatar()
                            ->helperText('Client profile photo. Recommended: 400x400px')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Testimonial Content')
                    ->schema([
                        Textarea::make('testimonial')
                            ->required()
                            ->rows(5)
                            ->maxLength(1000)
                            ->helperText('The testimonial text')
                            ->columnSpanFull(),
                        
                        Select::make('rating')
                            ->label('Rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->default(5)
                            ->required()
                            ->helperText('Client rating (1-5 stars)'),
                        
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this testimonial'),
                        
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
