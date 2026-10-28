<?php

namespace App\Filament\Resources\JobApplications;

use App\Models\JobApplication;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\TrashedFilter;

class JobApplicationResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    protected static ?string $model = JobApplication::class;

    protected static string|\UnitEnum|null $navigationGroup = 'Careers & Referrals';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Candidate Dossiers';

    protected static ?int $navigationSort = 15;

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'contact', 'why_fit'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Contact' => $record->contact,
            'Role'    => $record->careerRole?->title ?? 'General Candidate',
            'Status'  => $record->status,
        ];
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return url('/admin/careers-and-referrals');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('contact')->searchable(),
                TextColumn::make('careerRole.title')->label('Target Role'),
                TextColumn::make('years_exp')->label('Years Exp'),
                TextColumn::make('status')->badge(),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                TrashedFilter::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [];
    }
}
