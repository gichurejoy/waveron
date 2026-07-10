<?php

namespace App\Filament\Resources\QuoteSubmissions\QuoteSubmissionResource\Pages;

use App\Filament\Resources\QuoteSubmissions\QuoteSubmissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuoteSubmission extends EditRecord
{
    protected static string $resource = QuoteSubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
