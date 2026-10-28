<?php

namespace App\Filament\Resources\Invoices;

use App\Models\Invoice;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\TrashedFilter;

class InvoiceResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $model = Invoice::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Financial Ledgers';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Invoices Directory';

    protected static ?int $navigationSort = 25;

    public static function getGloballySearchableAttributes(): array
    {
        return ['invoice_number', 'client_name', 'client_email', 'project_type'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Client' => $record->client_name,
            'Amount' => 'KES ' . number_format($record->amount),
            'Status' => $record->status,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return url('/admin/financial-ledger');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')->searchable()->sortable(),
                TextColumn::make('client_name')->searchable()->sortable(),
                TextColumn::make('client_email')->searchable(),
                TextColumn::make('project_type')->searchable(),
                TextColumn::make('amount')->money('KES')->sortable(),
                TextColumn::make('status')->badge(),
                TextColumn::make('issued_at')->date(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->defaultSort('invoice_number', 'desc');
    }

    public static function getPages(): array
    {
        return [];
    }
}
