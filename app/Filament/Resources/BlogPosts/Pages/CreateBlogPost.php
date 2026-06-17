<?php

namespace App\Filament\Resources\BlogPosts\Pages;

use App\Filament\Resources\BlogPosts\BlogPostResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\View\View;

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
            $this->getCreateFormAction()
                ->label('Publish')
                ->extraAttributes(['form' => 'form'])
                ->color('primary'),
        ];
    }

    protected function getFormActions(): array
    {
        return [];
    }
}
