<?php

namespace App\Filament\Resources\FastInquiries\FastInquiryResource\Pages;

use App\Filament\Resources\FastInquiries\FastInquiryResource;
use Filament\Resources\Pages\ListRecords;

class ListFastInquiries extends ListRecords
{
    protected static string $resource = FastInquiryResource::class;

    protected function getHeaderActions(): array { return []; }
}
