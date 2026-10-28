<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([
                        // Left Column: Credentials & Role
                        Group::make([
                            Section::make('Account & Identity')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('name')
                                            ->label('Full Name')
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->email()
                                            ->required()
                                            ->unique('users', 'email', ignoreRecord: true),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->tel()
                                            ->placeholder('+254 7XX XXX XXX'),

                                        TextInput::make('role')
                                            ->label('Role / Job Title')
                                            ->required()
                                            ->maxLength(100)
                                            ->placeholder('e.g. Sales Specialist'),
                                    ]),

                                    TextInput::make('password')
                                        ->label(fn ($record) => $record ? 'New Password (leave blank to keep current)' : 'Password')
                                        ->password()
                                        ->required(fn ($record) => $record === null)
                                        ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                                        ->dehydrated(fn ($state) => filled($state))
                                        ->maxLength(255),
                                ]),

                            Section::make('Compensation & Commission Structure')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('commission_rate')
                                            ->label('Commission Rate (%)')
                                            ->numeric()
                                            ->default(10.00)
                                            ->suffix('%')
                                            ->required(),

                                        TextInput::make('base_salary')
                                            ->label('Monthly Base Salary')
                                            ->numeric()
                                            ->prefix('KES')
                                            ->placeholder('e.g. 60000'),
                                    ]),

                                    Grid::make(2)->schema([
                                        Select::make('payout_method')
                                            ->label('Payout Channel')
                                            ->options([
                                                'M-Pesa'        => 'M-Pesa',
                                                'Bank Transfer' => 'Bank Transfer',
                                            ])
                                            ->default('M-Pesa')
                                            ->required(),

                                        TextInput::make('payout_account')
                                            ->label('Payout Account (Phone / Bank Details)')
                                            ->placeholder('e.g. 0712345678 or KCB Bank / 123456789'),
                                    ]),
                                ]),
                        ])->columnSpan(8),

                        // Right Column: Status & Avatar
                        Group::make([
                            Section::make('Employment Status')
                                ->schema([
                                    Select::make('employment_status')
                                        ->label('Status')
                                        ->options([
                                            'Active'    => 'Active',
                                            'Probation' => 'Probation',
                                            'Inactive'  => 'Inactive',
                                            'Suspended' => 'Suspended',
                                        ])
                                        ->default('Active')
                                        ->required(),

                                    DatePicker::make('hired_at')
                                        ->label('Hire / Onboarding Date')
                                        ->default(now()),
                                ]),

                            Section::make('Profile Photo')
                                ->schema([
                                    FileUpload::make('avatar')
                                        ->label('Upload Avatar')
                                        ->image()
                                        ->disk('public')
                                        ->directory('avatars')
                                        ->placeholder(new HtmlString('Drag & Drop or <span style="color: #10b981; font-weight: 600; cursor: pointer; text-decoration: underline;">Upload Photo</span>'))
                                        ->imageResizeMode('force')
                                        ->imageCropAspectRatio('1:1')
                                        ->imageResizeTargetWidth('200')
                                        ->imageResizeTargetHeight('200'),
                                ]),
                        ])->columnSpan(4),
                    ])->columnSpan('full'),
            ]);
    }
}
