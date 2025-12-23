<?php

namespace App\Filament\Admin\Resources\PortfolioItems\Pages;

use App\Filament\Admin\Resources\PortfolioItems\PortfolioItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioItems extends ListRecords
{
    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
