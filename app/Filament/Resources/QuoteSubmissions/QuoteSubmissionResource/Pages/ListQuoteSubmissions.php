<?php

namespace App\Filament\Resources\QuoteSubmissions\QuoteSubmissionResource\Pages;

use App\Filament\Resources\QuoteSubmissions\QuoteSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuoteSubmissions extends ListRecords
{
    protected static string $resource = QuoteSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
