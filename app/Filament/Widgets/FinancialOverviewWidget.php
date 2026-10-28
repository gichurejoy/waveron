<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FinancialOverviewWidget extends BaseWidget
{
    protected ?string $pollingInterval = '30s';
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalInvoiced = (float) Invoice::sum('amount');
        $totalPaid     = (float) Invoice::where('status', 'Paid')->sum('amount');
        $totalPending  = (float) Invoice::where('status', 'Sent')->sum('amount');
        $overdueCount  = Invoice::where('status', 'Overdue')->count();
        $overdueAmount = (float) Invoice::where('status', 'Overdue')->sum('amount');

        $collectionRate = $totalInvoiced > 0 ? round(($totalPaid / $totalInvoiced) * 100, 1) : 0;

        return [
            Stat::make('Total Revenue Invoiced', 'KES ' . number_format($totalInvoiced))
                ->description(Invoice::count() . ' total invoices issued')
                ->descriptionIcon('heroicon-m-document-currency-dollar')
                ->color('primary')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Collected Payments', 'KES ' . number_format($totalPaid))
                ->description($collectionRate . '% collection rate')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->icon('heroicon-o-check-badge'),

            Stat::make('Pending Receivables', 'KES ' . number_format($totalPending))
                ->description(Invoice::where('status', 'Sent')->count() . ' awaiting client payment')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->icon('heroicon-o-clock'),

            Stat::make('Overdue Invoices', 'KES ' . number_format($overdueAmount))
                ->description($overdueCount . ' overdue ' . ($overdueCount === 1 ? 'invoice' : 'invoices'))
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($overdueCount > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-exclamation-circle'),
        ];
    }
}
