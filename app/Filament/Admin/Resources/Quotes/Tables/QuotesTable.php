<?php

namespace App\Filament\Admin\Resources\Quotes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class QuotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('quote_number')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->weight('bold'),
                
                TextColumn::make('service.title')
                    ->label('Service')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('service_type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'software' => 'success',
                        'design' => 'info',
                        'branding' => 'warning',
                        'marketing' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                
                TextColumn::make('complexity')
                    ->badge()
                    ->searchable(),
                
                TextColumn::make('timeline')
                    ->badge()
                    ->searchable(),
                
                TextColumn::make('total')
                    ->label('Total')
                    ->money('USD')
                    ->sortable(),
                
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'sent' => 'info',
                        'viewed' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        'expired' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                
                TextColumn::make('contact_name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('contact_email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                
                IconColumn::make('is_converted')
                    ->label('Converted')
                    ->boolean()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('expires_at')
                    ->label('Expires')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
                
                TextColumn::make('viewed_at')
                    ->label('Viewed')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'sent' => 'Sent',
                        'viewed' => 'Viewed',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                        'expired' => 'Expired',
                    ]),
                
                SelectFilter::make('service_type')
                    ->options([
                        'software' => 'Software Development',
                        'design' => 'Graphic Design',
                        'branding' => 'Branding',
                        'marketing' => 'Digital Marketing',
                    ]),
                
                SelectFilter::make('is_converted')
                    ->label('Converted')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('30s')
            ->striped();
    }
}

