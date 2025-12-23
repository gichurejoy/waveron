<?php

namespace App\Filament\Admin\Resources\Quotes\Pages;

use App\Filament\Admin\Resources\Quotes\QuoteResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewQuote extends ViewRecord
{
    protected static string $resource = QuoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('downloadPdf')
                ->label('Download PDF')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->url(fn () => route('quotes.download', $this->record))
                ->openUrlInNewTab(),
            EditAction::make(),
        ];
    }
}

