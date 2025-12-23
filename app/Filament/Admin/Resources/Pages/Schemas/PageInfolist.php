<?php

namespace App\Filament\Admin\Resources\Pages\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class PageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    TextEntry::make('title')
                        ->size('lg')
                        ->weight('bold')
                        ->columnSpan(2),
                    
                    TextEntry::make('slug')
                        ->copyable()
                        ->color('gray'),
                    
                    TextEntry::make('description')
                        ->columnSpanFull(),
                    
                    IconEntry::make('is_published')
                        ->label('Published')
                        ->boolean(),
                    
                    TextEntry::make('sort_order')
                        ->label('Sort Order'),
                ])
                ->columns(2),

                Group::make([
                    TextEntry::make('hero_title')
                        ->label('Hero Title'),
                    
                    TextEntry::make('hero_subtitle')
                        ->label('Hero Subtitle')
                        ->columnSpanFull(),
                    
                    ImageEntry::make('hero_image')
                        ->label('Hero Image')
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

                Group::make([
                    TextEntry::make('content')
                        ->html()
                        ->columnSpanFull(),
                ])
                ->columnSpanFull(),

                Group::make([
                    TextEntry::make('created_at')
                        ->label('Created At')
                        ->dateTime(),
                    
                    TextEntry::make('updated_at')
                        ->label('Updated At')
                        ->dateTime(),
                ])
                ->columns(2),
            ]);
    }
}