<?php

namespace App\Filament\Resources\Employees\Pages;

use App\Filament\Resources\Employees\EmployeeResource;
use App\Models\EmployeePayout;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewEmployee extends ViewRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('recordPayout')
                ->label('Record Payout')
                ->icon('heroicon-o-banknotes')
                ->color('success')
                ->modalWidth('lg')
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
                        ->default(fn () => $this->record->payout_method ?? 'M-Pesa')
                        ->required(),
                    TextInput::make('payout_account')
                        ->label('Recipient Account')
                        ->default(fn () => $this->record->payout_account ?? $this->record->phone),
                    TextInput::make('transaction_reference')
                        ->label('Receipt / Ref Code (e.g. M-Pesa Code)')
                        ->placeholder('e.g. QKH712XYZ9'),
                    DatePicker::make('paid_at')
                        ->label('Payment Date')
                        ->default(now()),
                    Textarea::make('notes')
                        ->label('Internal Notes')
                        ->placeholder('e.g. Commission for Acme Corp project phase 1')
                        ->rows(2),
                ])
                ->action(function (array $data) {
                    $payout = EmployeePayout::create([
                        'user_id'               => $this->record->id,
                        'amount'                => $data['amount'],
                        'type'                  => $data['type'],
                        'status'                => $data['status'],
                        'payout_method'         => $data['payout_method'],
                        'payout_account'        => $data['payout_account'] ?? null,
                        'transaction_reference' => $data['transaction_reference'] ?? null,
                        'paid_at'               => $data['paid_at'] ?? null,
                        'notes'                 => $data['notes'] ?? null,
                    ]);

                    \App\Models\AuditLog::logAction(
                        'Employee Payout Recorded',
                        "Disbursed {$data['type']} payout of KES " . number_format($data['amount']) . " to {$this->record->name} ({$this->record->email}) via {$data['payout_method']}",
                        'EmployeePayout',
                        $payout->id
                    );

                    Notification::make()
                        ->title('Payout Recorded')
                        ->body('KES ' . number_format($data['amount']) . ' recorded for ' . $this->record->name . '.')
                        ->success()
                        ->send();
                }),

            EditAction::make(),
            DeleteAction::make(),
        ];
    }
}
