<?php

namespace App\Filament\Resources\QuoteSubmissions;

use App\Filament\Resources\QuoteSubmissions\QuoteSubmissionResource\Pages;
use App\Models\QuoteSubmission;
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

class QuoteSubmissionResource extends Resource
{
    protected static ?string $model = QuoteSubmission::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calculator';

    protected static string|\UnitEnum|null $navigationGroup = 'Leads & Inquiries';

    protected static ?string $navigationLabel = 'Quote Submissions';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'user_email';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'New')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('status')
                ->options([
                    'New'       => 'New',
                    'In Review' => 'In Review',
                    'Converted' => 'Converted',
                    'Archived'  => 'Archived',
                ])
                ->required(),
            Forms\Components\Textarea::make('internal_notes')
                ->rows(4)
                ->columnSpanFull(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Quote Details')
                ->schema([
                    TextEntry::make('user_email')->label('Email')->icon('heroicon-o-envelope'),
                    TextEntry::make('service_type')->label('Service Type'),
                    TextEntry::make('complexity')->label('Complexity'),
                    TextEntry::make('timeline')->label('Timeline'),
                    TextEntry::make('estimated_total')
                        ->label('Estimated Total')
                        ->formatStateUsing(fn ($state) => 'KES ' . number_format($state)),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'New'       => 'info',
                            'In Review' => 'warning',
                            'Converted' => 'success',
                            'Archived'  => 'gray',
                            default     => 'gray',
                        }),
                    TextEntry::make('created_at')
                        ->label('Submitted')
                        ->dateTime('d M Y, H:i'),
                ])->columns(2),

            Section::make('Features & Add-ons')
                ->schema([
                    TextEntry::make('selected_features')
                        ->label('Selected Features')
                        ->listWithLineBreaks()
                        ->bulleted(),
                    TextEntry::make('selected_addons')
                        ->label('Selected Add-ons')
                        ->listWithLineBreaks()
                        ->bulleted(),
                ])->columns(2),

            Section::make('Internal Notes')
                ->schema([
                    TextEntry::make('internal_notes')
                        ->label('')
                        ->placeholder('No internal notes yet.'),
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
                    ->prefix('QTE-'),

                Tables\Columns\TextColumn::make('user_email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-o-envelope')
                    ->copyable(),

                Tables\Columns\TextColumn::make('service_type')
                    ->label('Service')
                    ->searchable()
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('complexity')
                    ->label('Complexity')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('timeline')
                    ->label('Timeline')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('estimated_total')
                    ->label('Estimated Total')
                    ->formatStateUsing(fn ($state) => 'KES ' . number_format($state))
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'info'    => 'New',
                        'warning' => 'In Review',
                        'success' => 'Converted',
                        'gray'    => 'Archived',
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
                        'In Review' => 'In Review',
                        'Converted' => 'Converted',
                        'Archived'  => 'Archived',
                    ]),
                Tables\Filters\SelectFilter::make('service_type')
                    ->label('Service Type')
                    ->options([
                        'Software Development (web/app platforms)' => 'Software Development',
                        'Graphic / UI Design'                       => 'Graphic / UI Design',
                        'Branding & Identity'                       => 'Branding & Identity',
                        'Digital Marketing'                         => 'Digital Marketing',
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
                                'In Review' => 'In Review',
                                'Converted' => 'Converted',
                                'Archived'  => 'Archived',
                            ])
                            ->required(),
                    ])
                    ->action(fn (QuoteSubmission $record, array $data) => $record->update(['status' => $data['status']]))
                    ->color('warning'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('mark_in_review')
                        ->label('Mark as In Review')
                        ->icon('heroicon-o-eye')
                        ->action(fn ($records) => $records->each->update(['status' => 'In Review'])),
                    BulkAction::make('mark_converted')
                        ->label('Mark as Converted')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['status' => 'Converted'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuoteSubmissions::route('/'),
            'view'  => Pages\ViewQuoteSubmission::route('/{record}'),
            'edit'  => Pages\EditQuoteSubmission::route('/{record}/edit'),
        ];
    }
}
