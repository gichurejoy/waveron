<?php

namespace App\Filament\Resources\FastInquiries;

use App\Filament\Resources\FastInquiries\FastInquiryResource\Pages;
use App\Models\FastInquiry;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;

class FastInquiryResource extends Resource
{
    protected static ?string $model = FastInquiry::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bolt';

    protected static string|\UnitEnum|null $navigationGroup = 'Leads & Inquiries';

    protected static ?string $navigationLabel = 'Fast Inquiries';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'New')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('status')
                ->options([
                    'New'       => 'New',
                    'Contacted' => 'Contacted',
                    'Qualified' => 'Qualified',
                    'Lost'      => 'Lost',
                ])
                ->required(),
            Forms\Components\Textarea::make('note_text')
                ->label('Add Internal Note')
                ->rows(3)
                ->columnSpanFull()
                ->helperText('This note will be appended to the existing notes.'),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Information')
                ->schema([
                    TextEntry::make('name')->label('Name')->icon('heroicon-o-user'),
                    TextEntry::make('email')->label('Email')->icon('heroicon-o-envelope')->copyable(),
                    TextEntry::make('company')->label('Company')->icon('heroicon-o-building-office'),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'New'       => 'info',
                            'Contacted' => 'warning',
                            'Qualified' => 'success',
                            'Lost'      => 'danger',
                            default     => 'gray',
                        }),
                    TextEntry::make('created_at')->label('Submitted')->dateTime('d M Y, H:i'),
                ])->columns(2),

            Section::make('Project Details')
                ->schema([
                    TextEntry::make('services_requested')->label('Services Requested'),
                    TextEntry::make('budget')->label('Budget'),
                    TextEntry::make('timeline')->label('Timeline'),
                    TextEntry::make('project_details')
                        ->label('Project Details')
                        ->columnSpanFull(),
                ])->columns(2),

            Section::make('Internal Notes')
                ->schema([
                    RepeatableEntry::make('internal_notes')
                        ->label('')
                        ->schema([
                            TextEntry::make('')->formatStateUsing(fn ($state) => $state),
                        ])
                        ->contained(false),
                ])->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->prefix('INQ-'),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('company')
                    ->label('Company')
                    ->searchable()
                    ->icon('heroicon-o-building-office'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('services_requested')
                    ->label('Services')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->services_requested),

                Tables\Columns\TextColumn::make('budget')
                    ->label('Budget')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'info'    => 'New',
                        'warning' => 'Contacted',
                        'success' => 'Qualified',
                        'danger'  => 'Lost',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'New'       => 'New',
                        'Contacted' => 'Contacted',
                        'Qualified' => 'Qualified',
                        'Lost'      => 'Lost',
                    ]),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From'),
                        Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($q, $date) => $q->whereDate('created_at', '>=', $date))
                            ->when($data['until'], fn ($q, $date) => $q->whereDate('created_at', '<=', $date));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('change_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('New Status')
                            ->options([
                                'New'       => 'New',
                                'Contacted' => 'Contacted',
                                'Qualified' => 'Qualified',
                                'Lost'      => 'Lost',
                            ])
                            ->required(),
                        Forms\Components\Textarea::make('note')
                            ->label('Internal Note (optional)')
                            ->rows(2),
                    ])
                    ->action(function (FastInquiry $record, array $data) {
                        $notes = $record->internal_notes ?? [];
                        if (!empty($data['note'])) {
                            $notes[] = '[' . now()->format('d M Y H:i') . '] ' . $data['note'];
                        }
                        $record->update(['status' => $data['status'], 'internal_notes' => $notes]);
                    })
                    ->color('warning'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('mark_contacted')
                        ->label('Mark as Contacted')
                        ->icon('heroicon-o-phone')
                        ->action(fn ($records) => $records->each->update(['status' => 'Contacted'])),
                    BulkAction::make('mark_qualified')
                        ->label('Mark as Qualified')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['status' => 'Qualified'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFastInquiries::route('/'),
            'view'  => Pages\ViewFastInquiry::route('/{record}'),
            'edit'  => Pages\EditFastInquiry::route('/{record}/edit'),
        ];
    }
}
