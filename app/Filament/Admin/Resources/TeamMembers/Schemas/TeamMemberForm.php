<?php

namespace App\Filament\Admin\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(2),
                        
                        TextInput::make('position')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Software Engineer, Designer, etc.')
                            ->columnSpan(1),
                        
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255)
                            ->placeholder('name@waveron.com'),
                        
                        FileUpload::make('image')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('team')
                            ->maxSize(1024)
                            ->imageEditor()
                            ->avatar()
                            ->helperText('Team member photo. Recommended: 400x400px')
                            ->columnSpanFull(),
                        
                        Textarea::make('bio')
                            ->label('Biography')
                            ->rows(4)
                            ->maxLength(500)
                            ->helperText('Short bio about the team member')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Section::make('Social Links')
                    ->schema([
                        TextInput::make('linkedin_url')
                            ->label('LinkedIn URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/in/username'),
                        
                        TextInput::make('github_url')
                            ->label('GitHub URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://github.com/username'),
                        
                        TextInput::make('twitter_url')
                            ->label('Twitter/X URL')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://twitter.com/username')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Visibility & Ordering')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Published')
                            ->default(true)
                            ->helperText('Toggle to show/hide this team member'),
                        
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0)
                            ->helperText('Lower numbers appear first'),
                    ])
                    ->columns(2),
            ]);
    }
}
