<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class EmployeeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([
                        // Left column (8 cols): Primary Details, Compensation, Recruitment Dossier
                        Group::make([
                            // Profile & Identity
                            Section::make('Employee Profile & Credentials')
                                ->icon('heroicon-o-user')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextEntry::make('name')
                                            ->label('Full Name')
                                            ->weight(FontWeight::Bold)
                                            ->size(TextSize::Large),

                                        TextEntry::make('role')
                                            ->label('Designation / Role')
                                            ->badge()
                                            ->colors([
                                                'primary' => fn ($state) => $state !== 'Administrator',
                                                'success' => 'Administrator',
                                            ]),

                                        TextEntry::make('employment_status')
                                            ->label('Employment Status')
                                            ->badge()
                                            ->colors([
                                                'success' => 'Active',
                                                'warning' => 'Probation',
                                                'gray'    => 'Inactive',
                                                'danger'  => 'Suspended',
                                            ]),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextEntry::make('email')
                                            ->label('Corporate / Direct Email')
                                            ->icon('heroicon-o-envelope')
                                            ->copyable()
                                            ->copyMessage('Email copied'),

                                        TextEntry::make('phone')
                                            ->label('Phone Number / Contact')
                                            ->icon('heroicon-o-phone')
                                            ->placeholder('Not specified')
                                            ->copyable()
                                            ->copyMessage('Phone copied'),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextEntry::make('hired_at')
                                            ->label('Onboarding / Hire Date')
                                            ->dateTime('M d, Y')
                                            ->placeholder(fn ($record) => $record->created_at->format('M d, Y')),

                                        TextEntry::make('created_at')
                                            ->label('Account Created')
                                            ->dateTime('M d, Y H:i')
                                            ->color('gray'),
                                    ]),
                                ]),

                            // Compensation & Remuneration Structure
                            Section::make('Compensation & Remuneration Agreement')
                                ->icon('heroicon-o-banknotes')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextEntry::make('commission_rate')
                                            ->label('Commission Rate')
                                            ->formatStateUsing(fn ($state) => number_format((float) $state, 1) . '%')
                                            ->color('success')
                                            ->badge()
                                            ->weight(FontWeight::Bold),

                                        TextEntry::make('base_salary')
                                            ->label('Monthly Base Retainer')
                                            ->money('KES')
                                            ->placeholder('Commission-only (KES 0.00 base)'),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextEntry::make('payout_method')
                                            ->label('Default Payout Channel')
                                            ->badge()
                                            ->color('primary'),

                                        TextEntry::make('payout_account')
                                            ->label('Designated Account Details')
                                            ->placeholder('Use primary phone number')
                                            ->copyable(),
                                    ]),
                                ]),

                            // Financial Overview / Stats Card
                            Section::make('Earnings & Disbursal Ledger Summary')
                                ->icon('heroicon-o-currency-dollar')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextEntry::make('total_paid_payouts')
                                            ->label('Total Disbursed (Paid)')
                                            ->state(fn ($record) => $record->total_paid_payouts)
                                            ->money('KES')
                                            ->weight(FontWeight::Bold)
                                            ->color('success')
                                            ->size(TextSize::Large),

                                        TextEntry::make('pending_payouts')
                                            ->label('Pending Approvals')
                                            ->state(fn ($record) => $record->pending_payouts)
                                            ->money('KES')
                                            ->weight(FontWeight::SemiBold)
                                            ->color(fn ($state) => $state > 0 ? 'warning' : 'gray'),

                                        TextEntry::make('payouts_count')
                                            ->label('Total Disbursements')
                                            ->state(fn ($record) => $record->payouts_count . ' records')
                                            ->color('info')
                                            ->badge(),
                                    ]),
                                ]),

                            // Candidate Recruitment Dossier (if candidate was onboarded from job_applications)
                            Section::make('Candidate Recruitment Dossier')
                                ->icon('heroicon-o-clipboard-document-check')
                                ->description('Historical records from candidate application and interview process.')
                                ->visible(fn ($record) => $record->job_application_id !== null || $record->jobApplication !== null)
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextEntry::make('jobApplication.careerRole.title')
                                            ->label('Position Applied For')
                                            ->badge()
                                            ->color('info')
                                            ->placeholder('General Candidate'),

                                        TextEntry::make('jobApplication.years_exp')
                                            ->label('Years of Experience')
                                            ->formatStateUsing(fn ($state) => $state ? "{$state} Years" : '—'),
                                    ]),

                                    Grid::make(2)->schema([
                                        TextEntry::make('jobApplication.created_at')
                                            ->label('Application Submitted On')
                                            ->dateTime('M d, Y H:i'),

                                        TextEntry::make('jobApplication.resume_path')
                                            ->label('Submitted Resume / CV')
                                            ->formatStateUsing(fn ($state) => $state ? '📄 View / Download CV' : 'No CV uploaded')
                                            ->url(fn ($record) => $record->jobApplication?->resume_path ? asset('storage/' . $record->jobApplication->resume_path) : null, true)
                                            ->color('primary')
                                            ->weight(FontWeight::SemiBold),
                                    ]),

                                    TextEntry::make('jobApplication.why_fit')
                                        ->label('Candidate Pitch / Fit Rationale')
                                        ->placeholder('—')
                                        ->columnSpanFull(),

                                    Grid::make(2)->schema([
                                        TextEntry::make('jobApplication.largest_deal')
                                            ->label('Track Record: Largest Deal')
                                            ->placeholder('—'),

                                        TextEntry::make('jobApplication.proud_sale')
                                            ->label('Proudest Achievement')
                                            ->placeholder('—'),
                                    ]),

                                    TextEntry::make('jobApplication.first_clients')
                                        ->label('Client Acquisition Strategy')
                                        ->placeholder('—')
                                        ->columnSpanFull(),

                                    TextEntry::make('jobApplication.internal_notes')
                                        ->label('Recruitment & Interview Notes')
                                        ->formatStateUsing(function ($state) {
                                            if (is_array($state)) {
                                                return implode("\n", $state);
                                            }
                                            return $state ?: 'No internal notes';
                                        })
                                        ->columnSpanFull(),
                                ]),
                        ])->columnSpan(8),

                        // Right column (4 cols): Avatar card, quick meta
                        Group::make([
                            Section::make('Profile Picture')
                                ->schema([
                                    ImageEntry::make('avatar')
                                        ->label('')
                                        ->circular()
                                        ->disk('public')
                                        ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=10B981&background=ECFDF5&size=256'),
                                ]),

                            Section::make('Employee Metadata')
                                ->schema([
                                    TextEntry::make('id')
                                        ->label('Employee ID')
                                        ->formatStateUsing(fn ($state) => sprintf('#EMP-%04d', $state))
                                        ->badge()
                                        ->color('gray'),

                                    TextEntry::make('total_commission_paid')
                                        ->label('Lifetime Commission Paid')
                                        ->state(fn ($record) => $record->total_commission_paid)
                                        ->money('KES')
                                        ->color('success'),

                                    TextEntry::make('email_verified_at')
                                        ->label('Email Verification')
                                        ->dateTime('M d, Y')
                                        ->placeholder('Unverified'),
                                ]),
                        ])->columnSpan(4),
                    ])->columnSpan('full'),
            ]);
    }
}
