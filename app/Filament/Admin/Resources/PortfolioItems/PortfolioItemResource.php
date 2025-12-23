<?php

namespace App\Filament\Admin\Resources\PortfolioItems;

use App\Filament\Admin\Resources\PortfolioItems\Pages\CreatePortfolioItem;
use App\Filament\Admin\Resources\PortfolioItems\Pages\EditPortfolioItem;
use App\Filament\Admin\Resources\PortfolioItems\Pages\ListPortfolioItems;
use App\Filament\Admin\Resources\PortfolioItems\Schemas\PortfolioItemForm;
use App\Filament\Admin\Resources\PortfolioItems\Tables\PortfolioItemsTable;
use App\Models\PortfolioItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PortfolioItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfolioItemsTable::configure($table);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_published', true)->count();
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Content';
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortfolioItems::route('/'),
            'create' => CreatePortfolioItem::route('/create'),
            'edit' => EditPortfolioItem::route('/{record}/edit'),
        ];
    }
}
