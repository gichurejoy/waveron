<?php

namespace App\Filament\Resources\ContactSubmissions;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource\Pages;
use App\Models\ContactSubmission;
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
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;

class ContactSubmissionResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $model = ContactSubmission::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static string|\UnitEnum|null $navigationGroup = 'Leads & Inquiries';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'full_name';

    public static function getGloballySearchableAttributes(): array
    {
        return ['full_name', 'email', 'company', 'subject'];
    }

    public static function getGlobalSearchResultDetails(\Illuminate\Database\Eloquent\Model $record): array
    {
        return [
            'Email'   => $record->email,
            'Subject' => $record->subject,
            'Status'  => $record->status,
        ];
    }

    public static function getGlobalSearchResultUrl(\Illuminate\Database\Eloquent\Model $record): string
    {
        return url('/admin/leads-and-inquiries');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'Unread')->count() ?: null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Select::make('status')
                ->options([
                    'Unread'  => 'Unread',
                    'Read'    => 'Read',
                    'Replied' => 'Replied',
                ])
                ->required(),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contact Information')
                ->schema([
                    TextEntry::make('full_name')->label('Name')->icon('heroicon-o-user'),
                    TextEntry::make('email')->label('Email')->icon('heroicon-o-envelope')->copyable(),
                    TextEntry::make('company')->label('Company')->icon('heroicon-o-building-office'),
                    TextEntry::make('status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Unread'  => 'danger',
                            'Read'    => 'info',
                            'Replied' => 'success',
                            default   => 'gray',
                        }),
                    TextEntry::make('created_at')->label('Received')->dateTime('d M Y, H:i'),
                ])->columns(2),

            Section::make('Message')
                ->schema([
                    TextEntry::make('subject')
                        ->label('Subject')
                        ->weight('bold')
                        ->columnSpanFull(),
                    TextEntry::make('message')
                        ->label('')
                        ->columnSpanFull(),
                ]),

            Section::make('Additional Details')
                ->schema([
                    TextEntry::make('budget')->label('Budget'),
                    TextEntry::make('timeline')->label('Timeline'),
                    TextEntry::make('services')->label('Services Interested'),
                ])->columns(3)->collapsible(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->prefix('CNT-'),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->copyable()
                    ->icon('heroicon-o-envelope'),

                Tables\Columns\TextColumn::make('subject')
                    ->label('Subject')
                    ->searchable()
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->subject),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'danger'  => 'Unread',
                        'info'    => 'Read',
                        'success' => 'Replied',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Unread'  => 'Unread',
                        'Read'    => 'Read',
                        'Replied' => 'Replied',
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
                ViewAction::make()
                    ->after(fn (ContactSubmission $record) => $record->status === 'Unread'
                        ? $record->update(['status' => 'Read'])
                        : null),
                Action::make('change_status')
                    ->label('Update Status')
                    ->icon('heroicon-o-arrow-path')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('New Status')
                            ->options([
                                'Unread'  => 'Unread',
                                'Read'    => 'Read',
                                'Replied' => 'Replied',
                            ])
                            ->required(),
                    ])
                    ->action(fn (ContactSubmission $record, array $data) => $record->update(['status' => $data['status']]))
                    ->color('warning'),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    BulkAction::make('mark_read')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-eye')
                        ->action(fn ($records) => $records->each->update(['status' => 'Read'])),
                    BulkAction::make('mark_replied')
                        ->label('Mark as Replied')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn ($records) => $records->each->update(['status' => 'Replied'])),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactSubmissions::route('/'),
            'view'  => Pages\ViewContactSubmission::route('/{record}'),
            'edit'  => Pages\EditContactSubmission::route('/{record}/edit'),
        ];
    }
}
