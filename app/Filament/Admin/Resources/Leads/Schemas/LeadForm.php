<?php

namespace App\Filament\Admin\Resources\Leads\Schemas;

use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lead Information')
                    ->schema([
                        TextInput::make('lead_number')
                            ->label('Lead Number')
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->dehydrated()
                            ->columnSpan(1),
                        
                        Select::make('status')
                            ->required()
                            ->options([
                                'new' => 'New',
                                'contacted' => 'Contacted',
                                'qualified' => 'Qualified',
                                'proposal_sent' => 'Proposal Sent',
                                'converted' => 'Converted',
                                'lost' => 'Lost',
                            ])
                            ->default('new')
                            ->columnSpan(1),
                        
                        Select::make('source')
                            ->label('Source')
                            ->options([
                                'website' => 'Website',
                                'referral' => 'Referral',
                                'cold_call' => 'Cold Call',
                                'social_media' => 'Social Media',
                                'email' => 'Email',
                                'other' => 'Other',
                            ])
                            ->columnSpan(1),
                        
                        Select::make('assigned_to')
                            ->label('Assigned To')
                            ->relationship('assignedUser', 'name')
                            ->searchable()
                            ->preload()
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Section::make('Contact Information')
                    ->schema([
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('company')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('job_title')
                            ->label('Job Title')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('website')
                            ->url()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-o-globe-alt')
                            ->columnSpan(2),
                    ])
                    ->columns(2),

                Section::make('Address Information')
                    ->schema([
                        Textarea::make('address')
                            ->rows(2)
                            ->columnSpanFull(),
                        
                        TextInput::make('city')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('state')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('zip_code')
                            ->label('Zip Code')
                            ->maxLength(255)
                            ->columnSpan(1),
                        
                        TextInput::make('country')
                            ->maxLength(255)
                            ->columnSpan(1),
                    ])
                    ->columns(2)
                    ->collapsible(),

                Section::make('Lead Details')
                    ->schema([
                        TextInput::make('estimated_value')
                            ->label('Estimated Value')
                            ->numeric()
                            ->prefix('$')
                            ->columnSpan(1),
                        
                        DatePicker::make('contacted_at')
                            ->label('Contacted At')
                            ->columnSpan(1),
                        
                        DatePicker::make('converted_at')
                            ->label('Converted At')
                            ->columnSpan(1),
                        
                        Textarea::make('notes')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->collapsible(),
            ]);
    }
}
