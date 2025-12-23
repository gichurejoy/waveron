<?php

namespace App\Filament\Admin\Resources\Leads\Pages;

use App\Filament\Admin\Resources\Leads\LeadResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Session;

class ListLeads extends ListRecords
{
    protected static string $resource = LeadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('toggleView')
                ->label(fn () => $this->isGridView() ? 'List View' : 'Grid View')
                ->icon(fn () => $this->isGridView() ? 'heroicon-o-list-bullet' : 'heroicon-o-squares-2x2')
                ->action(function () {
                    Session::put('leads_view_mode', $this->isGridView() ? 'table' : 'grid');
                    $this->redirect(static::getUrl());
                })
                ->color('gray'),
        ];
    }

    protected function isGridView(): bool
    {
        return Session::get('leads_view_mode', 'table') === 'grid';
    }

    protected function configureTable(): void
    {
        parent::configureTable();
        
        if ($this->isGridView()) {
            $this->table
                ->contentGrid([
                    'md' => 2,
                    'xl' => 3,
                ]);
        }
    }
}

