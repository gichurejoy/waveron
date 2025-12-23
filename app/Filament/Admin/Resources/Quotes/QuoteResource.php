<?php

namespace App\Filament\Admin\Resources\Quotes;

use App\Filament\Admin\Resources\Quotes\Pages\CreateQuote;
use App\Filament\Admin\Resources\Quotes\Pages\EditQuote;
use App\Filament\Admin\Resources\Quotes\Pages\ListQuotes;
use App\Filament\Admin\Resources\Quotes\Pages\ViewQuote;
use App\Filament\Admin\Resources\Quotes\Schemas\QuoteForm;
use App\Filament\Admin\Resources\Quotes\Schemas\QuoteInfolist;
use App\Filament\Admin\Resources\Quotes\Tables\QuotesTable;
use App\Models\Quote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'quote_number';

    public static function form(Schema $schema): Schema
    {
        return QuoteForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return QuoteInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuotesTable::configure($table);
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
            'index' => ListQuotes::route('/'),
            'create' => CreateQuote::route('/create'),
            'view' => ViewQuote::route('/{record}'),
            'edit' => EditQuote::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'draft')->count();
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Quotes';
    }
}

