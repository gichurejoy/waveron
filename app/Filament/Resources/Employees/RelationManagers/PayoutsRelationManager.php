<?php

namespace App\Filament\Resources\Employees\RelationManagers;

use App\Models\AuditLog;
use App\Models\EmployeePayout;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PayoutsRelationManager extends RelationManager
{
    protected static string $relationship = 'payouts';

    protected static ?string $title = 'Payout & Commission History';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
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

            Select::make('status')
                ->label('Status')
                ->options([
                    'Pending'   => 'Pending',
                    'Approved'  => 'Approved',
                    'Paid'      => 'Paid',
                    'Cancelled' => 'Cancelled',
                ])
                ->default('Paid')
                ->required(),

            Select::make('payout_method')
                ->label('Disbursement Channel')
                ->options([
                    'M-Pesa'        => 'M-Pesa',
                    'Bank Transfer' => 'Bank Transfer',
                ])
                ->default('M-Pesa')
                ->required(),

            TextInput::make('payout_account')
                ->label('Recipient Account (Phone / Bank)')
                ->placeholder('e.g. 0712345678 or Bank Account'),

            TextInput::make('transaction_reference')
                ->label('Ref / Receipt Code')
                ->placeholder('e.g. QKH712XYZ9 or Bank Wire Ref'),

            DatePicker::make('paid_at')
                ->label('Disbursement Date')
                ->default(now()),

            Textarea::make('notes')
                ->label('Payment Notes / Deal Details')
                ->placeholder('e.g. Commission for Enterprise ERP System milestone 1')
                ->rows(2)
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('transaction_reference')
            ->defaultSort('paid_at', 'desc')
            ->columns([
                TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->colors([
                        'primary' => 'Commission',
                        'info'    => 'Base Salary',
                        'warning' => 'Bonus',
                        'success' => 'Referral Bounty',
                    ])
                    ->searchable(),

                TextColumn::make('amount')
                    ->label('Amount')
                    ->money('KES')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'warning' => 'Pending',
                        'info'    => 'Approved',
                        'success' => 'Paid',
                        'danger'  => 'Cancelled',
                    ]),

                TextColumn::make('payout_method')
                    ->label('Channel')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('payout_account')
                    ->label('Account')
                    ->placeholder('—')
                    ->copyable()
                    ->copyMessage('Account copied'),

                TextColumn::make('transaction_reference')
                    ->label('Reference / Code')
                    ->placeholder('—')
                    ->copyable()
                    ->copyMessage('Reference copied'),

                TextColumn::make('paid_at')
                    ->label('Date Disbursed')
                    ->dateTime('M d, Y')
                    ->placeholder('Pending')
                    ->sortable(),

                TextColumn::make('notes')
                    ->label('Notes')
                    ->limit(35)
                    ->placeholder('—')
                    ->tooltip(fn ($state) => $state),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'Commission'      => 'Commission',
                        'Base Salary'     => 'Base Salary',
                        'Bonus'           => 'Bonus',
                        'Referral Bounty' => 'Referral Bounty',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'Pending'   => 'Pending',
                        'Approved'  => 'Approved',
                        'Paid'      => 'Paid',
                        'Cancelled' => 'Cancelled',
                    ]),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Record New Payout')
                    ->icon('heroicon-o-plus')
                    ->after(function (EmployeePayout $record) {
                        AuditLog::logAction(
                            'Employee Payout Created',
                            "Recorded {$record->type} payout of KES " . number_format($record->amount) . " to employee {$record->user?->name}",
                            'EmployeePayout',
                            $record->id
                        );
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->after(function (EmployeePayout $record) {
                        AuditLog::logAction(
                            'Employee Payout Updated',
                            "Updated {$record->type} payout #{$record->id} (Status: {$record->status}, Amount: KES " . number_format($record->amount) . ")",
                            'EmployeePayout',
                            $record->id
                        );
                    }),
                DeleteAction::make()
                    ->after(function (EmployeePayout $record) {
                        AuditLog::logAction(
                            'Employee Payout Deleted',
                            "Deleted payout #{$record->id} of KES " . number_format($record->amount),
                            'EmployeePayout',
                            $record->id
                        );
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

