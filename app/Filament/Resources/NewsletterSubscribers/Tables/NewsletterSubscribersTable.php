<?php

namespace App\Filament\Resources\NewsletterSubscribers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Notifications\Notification;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Database\Eloquent\Collection;

class NewsletterSubscribersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('is_active')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Unsubscribed')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Subscription Date')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('export_csv')
                    ->label('Export CSV')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function () {
                        $subscribers = \App\Models\NewsletterSubscriber::all();
                        
                        $response = new StreamedResponse(function () use ($subscribers) {
                            $handle = fopen('php://output', 'w');
                            fputcsv($handle, ['Email Address', 'Subscription Date', 'Status']);

                            foreach ($subscribers as $subscriber) {
                                fputcsv($handle, [
                                    $subscriber->email,
                                    $subscriber->created_at->toDateTimeString(),
                                    $subscriber->is_active ? 'Active' : 'Unsubscribed',
                                ]);
                            }

                            fclose($handle);
                        });

                        $response->headers->set('Content-Type', 'text/csv');
                        $response->headers->set('Content-Disposition', 'attachment; filename="newsletter_subscribers_' . now()->format('Y-m-d') . '.csv"');

                        return $response;
                    })
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('unsubscribe')
                    ->label('Unsubscribe')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn ($record) => $record->is_active)
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['is_active' => false]);
                        
                        Notification::make()
                            ->title('Subscriber Unsubscribed')
                            ->body("{$record->email} has been unsubscribed.")
                            ->success()
                            ->send();
                    }),
                Action::make('subscribe')
                    ->label('Subscribe')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => !$record->is_active)
                    ->action(function ($record) {
                        $record->update(['is_active' => true]);
                        
                        Notification::make()
                            ->title('Subscriber Resubscribed')
                            ->body("{$record->email} is now active.")
                            ->success()
                            ->send();
                    }),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_unsubscribe')
                        ->label('Unsubscribe Selected')
                        ->icon('heroicon-o-x-circle')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $records->each(fn ($record) => $record->update(['is_active' => false]));
                            
                            Notification::make()
                                ->title('Selected Subscribers Unsubscribed')
                                ->success()
                                ->send();
                        }),
                    BulkAction::make('bulk_export_csv')
                        ->label('Export Selected to CSV')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('success')
                        ->action(function (Collection $records) {
                            $response = new StreamedResponse(function () use ($records) {
                                $handle = fopen('php://output', 'w');
                                fputcsv($handle, ['Email Address', 'Subscription Date', 'Status']);

                                foreach ($records as $subscriber) {
                                    fputcsv($handle, [
                                        $subscriber->email,
                                        $subscriber->created_at->toDateTimeString(),
                                        $subscriber->is_active ? 'Active' : 'Unsubscribed',
                                    ]);
                                }

                                fclose($handle);
                            });

                            $response->headers->set('Content-Type', 'text/csv');
                            $response->headers->set('Content-Disposition', 'attachment; filename="selected_newsletter_subscribers_' . now()->format('Y-m-d') . '.csv"');

                            return $response;
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
