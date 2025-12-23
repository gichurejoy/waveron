<?php

namespace App\Filament\Admin\Resources\PortfolioItems\Pages;

use App\Filament\Admin\Resources\PortfolioItems\PortfolioItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioItem extends CreateRecord
{
    protected static string $resource = PortfolioItemResource::class;
}
