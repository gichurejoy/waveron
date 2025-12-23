<?php

namespace App\Filament\Admin\Resources\Quotes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class QuoteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    TextEntry::make('quote_number')
                        ->size('lg')
                        ->weight('bold')
                        ->copyable()
                        ->columnSpan(2),
                    
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'draft' => 'gray',
                            'sent' => 'info',
                            'viewed' => 'warning',
                            'accepted' => 'success',
                            'rejected' => 'danger',
                            'expired' => 'gray',
                            default => 'gray',
                        })
                        ->columnSpan(1),
                    
                    TextEntry::make('service.title')
                        ->label('Service'),
                    
                    TextEntry::make('service_type')
                        ->badge(),
                    
                    TextEntry::make('total')
                        ->label('Total')
                        ->money('USD')
                        ->size('lg')
                        ->weight('bold'),
                ])
                ->columns(3),

                Group::make([
                    TextEntry::make('complexity')
                        ->label('Complexity')
                        ->badge(),
                    
                    TextEntry::make('timeline')
                        ->label('Timeline')
                        ->badge(),
                    
                    TextEntry::make('feature_count')
                        ->label('Features'),
                    
                    TextEntry::make('expires_at')
                        ->label('Expires At')
                        ->dateTime(),
                ])
                ->columns(4),

                Group::make([
                    TextEntry::make('contact_name')
                        ->label('Contact Name'),
                    
                    TextEntry::make('contact_email')
                        ->label('Email')
                        ->copyable(),
                    
                    TextEntry::make('contact_phone')
                        ->label('Phone'),
                    
                    IconEntry::make('is_converted')
                        ->label('Converted')
                        ->boolean(),
                ])
                ->columns(4),

                Group::make([
                    TextEntry::make('base_price')
                        ->label('Base Price')
                        ->money('USD'),
                    
                    TextEntry::make('subtotal')
                        ->label('Subtotal')
                        ->money('USD'),
                    
                    TextEntry::make('tax_amount')
                        ->label('Tax')
                        ->money('USD'),
                    
                    TextEntry::make('discount_amount')
                        ->label('Discount')
                        ->money('USD'),
                ])
                ->columns(4),

                Group::make([
                    TextEntry::make('created_at')
                        ->label('Created')
                        ->dateTime(),
                    
                    TextEntry::make('viewed_at')
                        ->label('Viewed')
                        ->dateTime(),
                    
                    TextEntry::make('updated_at')
                        ->label('Updated')
                        ->dateTime(),
                ])
                ->columns(3),
            ]);
    }
}

