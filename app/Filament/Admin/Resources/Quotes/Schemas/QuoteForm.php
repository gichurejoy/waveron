<?php

namespace App\Filament\Admin\Resources\Quotes\Schemas;

use App\Models\Service;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Quote Information')
                    ->schema([
                        TextInput::make('quote_number')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->columnSpan(1),
                        
                        Select::make('service_id')
                            ->label('Service')
                            ->relationship('service', 'title')
                            ->required()
                            ->searchable()
                            ->reactive()
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
                        
                        Select::make('status')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'sent' => 'Sent',
                                'viewed' => 'Viewed',
                                'accepted' => 'Accepted',
                                'rejected' => 'Rejected',
                                'expired' => 'Expired',
                            ])
                            ->default('draft')
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Section::make('Quote Configuration')
                    ->schema([
                        Select::make('complexity')
                            ->required()
                            ->options([
                                'basic' => 'Standard (MVP / straightforward)',
                                'advanced' => 'Advanced (integrations, custom workflows)',
                                'enterprise' => 'Enterprise (scalability, security, compliance)',
                            ])
                            ->columnSpan(1),
                        
                        Select::make('timeline')
                            ->required()
                            ->options([
                                'flexible' => 'Flexible (best value)',
                                'standard' => 'Standard',
                                'rush' => 'Rush / expedited',
                            ])
                            ->columnSpan(1),
                        
                        TextInput::make('feature_count')
                            ->label('Feature Count')
                            ->numeric()
                            ->required()
                            ->default(6)
                            ->columnSpan(1),
                        
                        TextInput::make('validity_days')
                            ->label('Validity (Days)')
                            ->numeric()
                            ->required()
                            ->default(30)
                            ->columnSpan(1),
                        
                        DateTimePicker::make('expires_at')
                            ->label('Expires At')
                            ->required()
                            ->columnSpan(2),
                    ])
                    ->columns(3),

                Section::make('Pricing')
                    ->schema([
                        TextInput::make('base_price')
                            ->label('Base Price')
                            ->numeric()
                            ->required()
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        TextInput::make('complexity_multiplier')
                            ->label('Complexity Multiplier')
                            ->numeric()
                            ->required()
                            ->default(1.0)
                            ->step(0.01)
                            ->columnSpan(1),
                        
                        TextInput::make('timeline_multiplier')
                            ->label('Timeline Multiplier')
                            ->numeric()
                            ->required()
                            ->default(1.0)
                            ->step(0.01)
                            ->columnSpan(1),
                        
                        TextInput::make('feature_adjustment')
                            ->label('Feature Adjustment')
                            ->numeric()
                            ->required()
                            ->default(1.0)
                            ->step(0.01)
                            ->columnSpan(1),
                        
                        TextInput::make('addons_total')
                            ->label('Add-ons Total')
                            ->numeric()
                            ->default(0)
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        TextInput::make('tax_rate')
                            ->label('Tax Rate (%)')
                            ->numeric()
                            ->suffix('%')
                            ->columnSpan(1),
                        
                        TextInput::make('discount_amount')
                            ->label('Discount Amount')
                            ->numeric()
                            ->default(0)
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        TextInput::make('discount_code')
                            ->label('Discount Code')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->required()
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        TextInput::make('tax_amount')
                            ->label('Tax Amount')
                            ->numeric()
                            ->default(0)
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->required()
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        Select::make('currency')
                            ->options([
                                'USD' => 'USD - US Dollar',
                                'EUR' => 'EUR - Euro',
                                'GBP' => 'GBP - British Pound',
                                'KES' => 'KES - Kenyan Shilling',
                            ])
                            ->default('USD')
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('contact_name')
                            ->label('Contact Name')
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        TextInput::make('contact_email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        TextInput::make('contact_phone')
                            ->label('Phone')
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->collapsible(),

                Section::make('Conversion Tracking')
                    ->schema([
                        Toggle::make('is_converted')
                            ->label('Converted to Order')
                            ->default(false),
                        
                        TextInput::make('converted_to_order_id')
                            ->label('Order ID')
                            ->numeric()
                            ->visible(fn ($get) => $get('is_converted')),
                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }
}

