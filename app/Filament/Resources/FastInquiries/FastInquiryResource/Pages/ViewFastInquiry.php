<?php

namespace App\Filament\Resources\FastInquiries\FastInquiryResource\Pages;

use App\Filament\Resources\FastInquiries\FastInquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFastInquiry extends ViewRecord
{
    protected static string $resource = FastInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\EditAction::make()];
    }
}
