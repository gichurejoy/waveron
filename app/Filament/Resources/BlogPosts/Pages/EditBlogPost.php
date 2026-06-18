<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditBlogPost extends EditRecord
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
                    $this->data['is_published'] = false;
                    $this->save();
                }),

            Action::make('publish')
                ->label('Publish')
                ->color('primary')
                ->action(function () {
                    $this->data['is_published'] = true;
                    if (empty($this->data['published_at'])) {
                        $this->data['published_at'] = now()->toDateString();
                    }
                    $this->save();
                }),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
