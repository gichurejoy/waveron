<?php

namespace App\Filament\Widgets;

use App\Models\QuoteSubmission;
use App\Models\FastInquiry;
use App\Models\ContactSubmission;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadsOverviewWidget extends BaseWidget
{
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $totalQuotes     = QuoteSubmission::count();
        $newQuotes       = QuoteSubmission::where('status', 'New')->count();
        $convertedQuotes = QuoteSubmission::where('status', 'Converted')->count();
        $conversionRate  = $totalQuotes > 0 ? round(($convertedQuotes / $totalQuotes) * 100, 1) : 0;

        $openInquiries = FastInquiry::whereIn('status', ['New', 'Contacted'])->count();
        $newInquiries  = FastInquiry::where('status', 'New')->count();

        $unreadContacts = ContactSubmission::where('status', 'Unread')->count();
        $totalContacts  = ContactSubmission::count();

        $weeklyQuotes = QuoteSubmission::where('created_at', '>=', now()->subDays(7))->count();

        return [
            Stat::make('Quote Submissions', $totalQuotes)
                ->description($newQuotes . ' new · ' . $weeklyQuotes . ' this week')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info')
                ->icon('heroicon-o-calculator')
                ->chart(
                    QuoteSubmission::selectRaw('COUNT(*) as count')
                        ->where('created_at', '>=', now()->subDays(7))
                        ->groupByRaw('DATE(created_at)')
                        ->pluck('count')
                        ->toArray()
                ),

            Stat::make('Open Inquiries', $openInquiries)
                ->description($newInquiries . ' new · awaiting response')
                ->descriptionIcon('heroicon-m-bolt')
                ->color('warning')
                ->icon('heroicon-o-bolt'),

            Stat::make('Unread Messages', $unreadContacts)
                ->description($totalContacts . ' total contact submissions')
                ->descriptionIcon('heroicon-m-chat-bubble-left-ellipsis')
                ->color($unreadContacts > 0 ? 'danger' : 'success')
                ->icon('heroicon-o-chat-bubble-left-ellipsis'),

            Stat::make('Conversion Rate', $conversionRate . '%')
                ->description($convertedQuotes . ' of ' . $totalQuotes . ' quotes converted')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color($conversionRate >= 20 ? 'success' : ($conversionRate >= 10 ? 'warning' : 'gray'))
                ->icon('heroicon-o-arrow-trending-up'),
        ];
    }
}
