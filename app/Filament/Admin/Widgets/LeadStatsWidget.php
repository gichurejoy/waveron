<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalLeads = Lead::count();
        $newLeads = Lead::where('status', 'new')->count();
        $qualifiedLeads = Lead::where('status', 'qualified')->count();
        $convertedLeads = Lead::where('status', 'converted')->count();
        $totalValue = Lead::whereNotNull('estimated_value')->sum('estimated_value');

        return [
            Stat::make('Total Leads', $totalLeads)
                ->description('All leads in system')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),
            
            Stat::make('New Leads', $newLeads)
                ->description('Requiring attention')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),
            
            Stat::make('Qualified Leads', $qualifiedLeads)
                ->description('Ready for proposal')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
            
            Stat::make('Converted Leads', $convertedLeads)
                ->description('Successfully converted')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('success'),
            
            Stat::make('Total Estimated Value', '$' . number_format($totalValue, 2))
                ->description('Potential revenue')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),
        ];
    }
}

