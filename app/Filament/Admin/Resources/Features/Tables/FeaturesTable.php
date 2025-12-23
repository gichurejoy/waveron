<?php

namespace App\Filament\Admin\Resources\Features\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FeaturesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),
                
                TextColumn::make('service_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'software' => 'success',
                        'design' => 'info',
                        'branding' => 'warning',
                        'marketing' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('group')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('description')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                IconColumn::make('is_default')
                    ->label('Default')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('gray'),
                
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                TextColumn::make('sort_order')
                    ->label('Order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('service_type')
                    ->options([
                        'software' => 'Software Development',
                        'design' => 'Graphic Design',
                        'branding' => 'Branding',
                        'marketing' => 'Digital Marketing',
                    ]),
                
                SelectFilter::make('group')
                    ->options(function () {
                        return \App\Models\Feature::distinct()
                            ->whereNotNull('group')
                            ->pluck('group', 'group')
                            ->toArray();
                    }),
                
                TernaryFilter::make('is_default')
                    ->label('Default')
                    ->placeholder('All features')
                    ->trueLabel('Default only')
                    ->falseLabel('Not default'),
                
                TernaryFilter::make('is_active')
                    ->label('Active')
                    ->placeholder('All features')
                    ->trueLabel('Active only')
                    ->falseLabel('Inactive'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->poll('30s')
            ->striped();
    }
}

