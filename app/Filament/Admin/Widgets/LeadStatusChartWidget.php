<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadStatusChartWidget extends ChartWidget
{
    protected ?string $heading = 'Leads by Status';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $statuses = Lead::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $labels = array_keys($statuses);
        $data = array_values($statuses);

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',   // new - blue
                        'rgba(251, 191, 36, 0.8)',   // contacted - yellow
                        'rgba(34, 197, 94, 0.8)',    // qualified - green
                        'rgba(168, 85, 247, 0.8)',   // proposal_sent - purple
                        'rgba(236, 72, 153, 0.8)',   // converted - pink
                        'rgba(239, 68, 68, 0.8)',    // lost - red
                    ],
                ],
            ],
            'labels' => array_map('ucfirst', $labels),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}

