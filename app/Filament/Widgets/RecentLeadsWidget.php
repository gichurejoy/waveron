<?php

namespace App\Filament\Widgets;

use App\Models\QuoteSubmission;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentLeadsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Recent Quote Inquiries';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                QuoteSubmission::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('user_email')
                    ->label('Client Email')
                    ->searchable(),
                TextColumn::make('company')
                    ->label('Company')
                    ->placeholder('N/A'),
                TextColumn::make('service_type')
                    ->label('Service Requested')
                    ->limit(28),
                TextColumn::make('estimated_total')
                    ->label('Est. Total')
                    ->money('KES')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'warning' => 'New',
                        'info'    => 'In Review',
                        'success' => 'Converted',
                        'gray'    => 'Archived',
                    ]),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since(),
            ])
            ->recordActions([
                Action::make('open')
                    ->label('View in Inbox')
                    ->icon('heroicon-m-arrow-top-right-on-square')
                    ->url(fn (): string => url('/admin/leads-and-inquiries')),
            ])
            ->paginated(false);
    }
}
