<?php

namespace App\Filament\Resources\BlogComments\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class BlogCommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->label('Blog Post')
                    ->limit(30)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Author')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('reply')
                    ->label('Admin Reply')
                    ->limit(40)
                    ->placeholder('— no reply —')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Approval Status')
                    ->placeholder('All Comments')
                    ->trueLabel('Approved Only')
                    ->falseLabel('Pending Approval Only'),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn ($record) => ! $record->is_approved)
                    ->action(function ($record) {
                        $record->update(['is_approved' => true]);
                        Notification::make()
                            ->title('Comment Approved')
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Unapprove')
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->visible(fn ($record) => $record->is_approved)
                    ->action(function ($record) {
                        $record->update(['is_approved' => false]);
                        Notification::make()
                            ->title('Comment Hidden')
                            ->warning()
                            ->send();
                    }),
                Action::make('quickReply')
                    ->label('Reply')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->color('info')
                    ->form([
                        Textarea::make('reply')
                            ->label('Admin Reply')
                            ->rows(3)
                            ->required(),
                    ])
                    ->fillForm(fn ($record): array => [
                        'reply' => $record->reply,
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'reply' => $data['reply'],
                            'is_approved' => true,
                        ]);
                        Notification::make()
                            ->title('Reply Saved & Approved')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulkApprove')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->update(['is_approved' => true]);
                            Notification::make()
                                ->title('Selected Comments Approved')
                                ->success()
                                ->send();
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
