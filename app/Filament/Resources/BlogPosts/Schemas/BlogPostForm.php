<?php

namespace App\Filament\Resources\BlogPosts\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

class BlogPostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)
                    ->schema([
                        // Left Column
                        Group::make([
                            TextInput::make('title')
                                ->label(new HtmlString('Title <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(Name your blog)</span>'))
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                            RichEditor::make('content')
                                ->label(new HtmlString('Content <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(Write your blog post)</span>'))
                                ->required()
                                ->toolbarButtons([
                                    'attachFiles',
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'undo',
                                    'textColor',
                                    'highlight',
                                ])
                                ->columnSpanFull(),
                        ])->columnSpan(8),

                        // Right Column
                        Group::make([
                            TextInput::make('slug')
                                ->label(new HtmlString('Slug <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(Select a slug for this blog)</span>'))
                                ->required()
                                ->unique('blog_posts', 'slug', ignoreRecord: true),

                            Textarea::make('excerpt')
                                ->label(new HtmlString('Excerpt <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(Add a short excerpt to summarize this post)</span>'))
                                ->rows(4)
                                ->columnSpanFull(),

                            Select::make('categories')
                                ->relationship('categories', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->label(new HtmlString('Category <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(Select a category your blog belongs.)</span>')),

                            DatePicker::make('published_at')
                                ->label(new HtmlString('Date <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(The date you would like to show for this post)</span>')),

                            FileUpload::make('featured_image')
                                ->image()
                                ->disk('public')
                                ->placeholder(new HtmlString('Drag and Drop Images or <span class="filepond--label-action" style="color: #2563eb; text-decoration: none; font-weight: 600; cursor: pointer;">Upload Image</span>'))
                                ->label('Cover Image'),

                            Select::make('author_id')
                                ->relationship('author', 'name')
                                ->searchable()
                                ->preload()
                                ->allowHtml()
                                ->getOptionLabelFromRecordUsing(function (Model $record) {
                                    $avatarUrl = $record->avatar 
                                        ? asset('storage/' . $record->avatar) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($record->name) . '&color=7F9CF5&background=EBF4FF';
                                    $role = $record->role ?? 'Marketing';
                                    return "
                                        <table style='border-collapse: collapse; border: none; padding: 0; margin: 0; width: auto; background: transparent;'>
                                            <tr style='background: transparent;'>
                                                <td style='padding: 0 12px 0 0; border: none; background: transparent; vertical-align: middle;'>
                                                    <img src='{$avatarUrl}' class='object-cover' style='width: 40px; height: 40px; border-radius: 6px; display: block; min-width: 40px;' />
                                                </td>
                                                <td style='padding: 0; border: none; background: transparent; vertical-align: middle; text-align: left;'>
                                                    <div style='font-weight: 600; font-size: 14px; color: #111827; line-height: 1.2;'>{$record->name}</div>
                                                    <div style='font-size: 12px; color: #6b7280; line-height: 1.2; margin-top: 2px;'>{$role}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    ";
                                })
                                ->label(new HtmlString('Author <span style="font-weight: normal; color: #9ca3af; margin-left: 4px;">(The writer of this post)</span>'))
                                ->extraAttributes(['class' => 'author-select-custom']),
                        ])->columnSpan(4),
                    ])->columnSpan('full'),
                \Filament\Forms\Components\Placeholder::make('custom_styles')
                    ->label('')
                    ->content(new HtmlString(view('filament.pages.blog-posts-style')->render()))
                    ->columnSpan('full'),
            ]);
    }
}
