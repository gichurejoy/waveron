<?php

namespace App\Filament\Resources\FastInquiries\FastInquiryResource\Pages;

use App\Filament\Resources\FastInquiries\FastInquiryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFastInquiry extends EditRecord
{
    protected static string $resource = FastInquiryResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\ViewAction::make(), Actions\DeleteAction::make()];
    }
}
