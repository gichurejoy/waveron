<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    public static function getNavigationIcon(): string | \BackedEnum | null
    {
        return 'heroicon-o-document-currency-dollar';
    }

    public static function getNavigationSort(): ?int
    {
        return 5;
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Operations';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Invoice Details')
                    ->schema([
                        Forms\Components\TextInput::make('invoice_number')
                            ->disabled()
                            ->dehydrated(false)
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('lead_id')
                            ->relationship('lead', 'id')
                            ->getOptionLabelFromRecordUsing(fn($record) => "{$record->first_name} {$record->last_name}")
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn($state, $set) => $set('project_id', null)),
                        Forms\Components\Select::make('project_id')
                            ->relationship('project', 'title', function ($query, $get) {
                                $leadId = $get('lead_id');
                                if (!$leadId) {
                                    return $query;
                                }
                                return $query->where('lead_id', $leadId);
                            })
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'sent' => 'Sent',
                                'paid' => 'Paid',
                                'overdue' => 'Overdue',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required()
                            ->default('draft'),
                    ])->columns(2),
                Section::make('Dates')
                    ->schema([
                        Forms\Components\DatePicker::make('issue_date')->required()->default(now()),
                        Forms\Components\DatePicker::make('due_date')->required()->default(now()->addDays(14)),
                    ])->columns(2),
                Section::make('Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('description')->required()->columnSpan(3),
                                Forms\Components\TextInput::make('quantity')->numeric()->default(1)->required()->columnSpan(1)
                                    ->reactive()->afterStateUpdated(fn($state, $set, $get) => $set('amount', $state * $get('unit_price'))),
                                Forms\Components\TextInput::make('unit_price')->numeric()->required()->columnSpan(1)
                                    ->reactive()->afterStateUpdated(fn($state, $set, $get) => $set('amount', $state * $get('quantity'))),
                                Forms\Components\TextInput::make('amount')->numeric()->disabled()->dehydrated()->columnSpan(1),
                            ])
                            ->columns(6)
                            ->live()
                            ->afterStateUpdated(function ($get, $set) {
                                $items = $get('items');
                                $subtotal = collect($items)->sum(fn($item) => $item['amount'] ?? 0);
                                $set('subtotal', $subtotal);
                                $set('total_amount', $subtotal + ($get('tax_amount') ?? 0));
                            }),
                    ]),
                Section::make('Totals')
                    ->schema([
                        Forms\Components\TextInput::make('subtotal')->numeric()->disabled()->dehydrated(),
                        Forms\Components\TextInput::make('tax_amount')->numeric()->default(0)
                            ->reactive()->afterStateUpdated(fn($state, $set, $get) => $set('total_amount', ($get('subtotal') ?? 0) + $state)),
                        Forms\Components\TextInput::make('total_amount')->numeric()->disabled()->dehydrated(),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice_number')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('lead.first_name')
                    ->label('Client')
                    ->formatStateUsing(fn($record) => $record->lead ? "{$record->lead->first_name} {$record->lead->last_name}" : '-'),
                Tables\Columns\TextColumn::make('total_amount')->money('USD')->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'paid' => 'success',
                        'overdue' => 'danger',
                        'cancelled' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('due_date')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'paid' => 'Paid',
                        'overdue' => 'Overdue',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            ->actions([
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
