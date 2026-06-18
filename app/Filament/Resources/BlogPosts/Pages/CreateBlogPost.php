<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateBlogPost extends CreateRecord
{
    protected static string $resource = BlogPostResource::class;

    public function getMaxContentWidth(): string | null
    {
        return 'full';
    }

    public function getTitle(): string
    {
        return 'Article Page';
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\BlogPostStyleWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            $this->getCancelFormAction()
                ->label('Cancel')
                ->color('gray'),

            Action::make('saveDraft')
                ->label('Save Draft')
                ->color('gray')
                ->action(function () {
                    $this->create();
                    $this->record->update(['is_published' => false]);
                }),

            $this->getCreateFormAction()
                ->label('Publish')
                ->color('primary')
                ->after(function () {
                    $this->record->update([
                        'is_published' => true,
                        'published_at' => $this->record->published_at ?? now()->toDateString(),
                    ]);
                }),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
