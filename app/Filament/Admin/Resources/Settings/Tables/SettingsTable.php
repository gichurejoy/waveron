<?php

namespace App\Filament\Admin\Resources\Settings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable(),
                
                TextColumn::make('label')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                
                TextColumn::make('value')
                    ->limit(60)
                    ->wrap()
                    ->copyable(),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'info',
                        'number' => 'success',
                        'boolean' => 'warning',
                        'image' => 'primary',
                        'url' => 'danger',
                        'email' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),
                
                TextColumn::make('group')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('description')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->since(),
                
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contact Information',
                        'social' => 'Social Media',
                        'seo' => 'SEO Settings',
                        'appearance' => 'Appearance',
                        'email' => 'Email Settings',
                    ]),
                
                SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'number' => 'Number',
                        'boolean' => 'Boolean',
                        'image' => 'Image',
                        'url' => 'URL',
                        'email' => 'Email',
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
            ->defaultSort('group', 'asc')
            ->poll('30s')
            ->striped();
    }
}
