<?php

namespace App\Filament\Resources\Employees\Tables;

use App\Models\AuditLog;
use App\Models\EmployeePayout;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class EmployeesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn ($record) => \App\Filament\Resources\Employees\EmployeeResource::getUrl('view', ['record' => $record]))
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Photo')
                    ->circular()
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=10B981&background=ECFDF5'),
                
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Phone / M-Pesa')
                    ->placeholder('—')
                    ->searchable(),

                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->colors([
                        'primary' => fn ($state) => $state !== 'Administrator',
                        'success' => 'Administrator',
                    ])
                    ->searchable()
                    ->sortable(),

                TextColumn::make('commission_rate')
                    ->label('Commission')
                    ->formatStateUsing(fn ($state) => number_format((float) $state, 1) . '%')
                    ->color('success')
                    ->sortable(),

                TextColumn::make('employment_status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'Active',
                        'warning' => 'Probation',
                        'gray'    => 'Inactive',
                        'danger'  => 'Suspended',
                    ])
                    ->sortable(),

                TextColumn::make('total_paid_payouts')
                    ->label('Total Disbursed')
                    ->money('KES')
                    ->state(fn ($record) => $record->total_paid_payouts),

                TextColumn::make('hired_at')
                    ->label('Hired Date')
                    ->dateTime('M d, Y')
                    ->placeholder(fn ($record) => $record->created_at->format('M d, Y'))
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('employment_status')
                    ->label('Employment Status')
                    ->options([
                        'Active'    => 'Active',
                        'Probation' => 'Probation',
                        'Inactive'  => 'Inactive',
                        'Suspended' => 'Suspended',
                    ]),
            ])
            ->recordActions([
                Action::make('recordPayout')
                    ->label('Pay Commission')
                    ->icon('heroicon-o-banknotes')
                    ->color('success')
                    ->form([
                        TextInput::make('amount')
                            ->label('Payout Amount (KES)')
                            ->numeric()
                            ->prefix('KES')
                            ->required(),
                        Select::make('type')
                            ->label('Payout Type')
                            ->options([
                                'Commission'      => 'Commission',
                                'Base Salary'     => 'Base Salary',
                                'Bonus'           => 'Performance Bonus',
                                'Referral Bounty' => 'Referral Bounty',
                            ])
                            ->default('Commission')
                            ->required(),
                        Select::make('payout_method')
                            ->label('Disbursement Channel')
                            ->options([
                                'M-Pesa'        => 'M-Pesa',
                                'Bank Transfer' => 'Bank Transfer',
                            ])
                            ->default(fn ($record) => $record->payout_method ?? 'M-Pesa')
                            ->required(),
                        TextInput::make('payout_account')
                            ->label('Recipient Account')
                            ->default(fn ($record) => $record->payout_account ?? $record->phone),
                        TextInput::make('transaction_reference')
                            ->label('Receipt / Ref Code (e.g. M-Pesa Code)')
                            ->placeholder('e.g. QKH712XYZ9 or Wire #8921'),
                        DatePicker::make('paid_at')
                            ->label('Payment Date')
                            ->default(now())
                            ->required(),
                        Textarea::make('notes')
                            ->label('Internal Notes')
                            ->placeholder('e.g. Commission for Acme Corp Web Development phase 1')
                            ->rows(2),
                    ])
                    ->action(function ($record, array $data) {
                        $payout = EmployeePayout::create([
                            'user_id'               => $record->id,
                            'amount'                => $data['amount'],
                            'type'                  => $data['type'],
                            'status'                => 'Paid',
                            'payout_method'         => $data['payout_method'],
                            'payout_account'        => $data['payout_account'] ?? null,
                            'transaction_reference' => $data['transaction_reference'] ?? null,
                            'paid_at'               => $data['paid_at'],
                            'notes'                 => $data['notes'] ?? null,
                        ]);

                        AuditLog::logAction(
                            'Employee Payout Recorded',
                            "Recorded {$data['type']} payout of KES " . number_format($data['amount']) . " to {$record->name} ({$record->email}) via {$data['payout_method']}",
                            'EmployeePayout',
                            $payout->id
                        );

                        Notification::make()
                            ->title('Payout Recorded Successfully')
                            ->body("Disbursed KES " . number_format($data['amount']) . " to {$record->name}.")
                            ->success()
                            ->send();
                    }),
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
