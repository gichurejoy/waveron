<?php

namespace App\Filament\Admin\Resources\Leads\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class LeadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            Group::make([
                // LEFT SIDEBAR (4 columns)
                Group::make([
                    // Status Badges
                    TextEntry::make('status_badges')
                        ->label('')
                        ->state(fn ($record) => true)
                        ->formatStateUsing(function ($state, $record) {
                            $badges = [];
                            if ($record->is_hot ?? false) {
                                $badges[] = '<span style="background: #fee2e2; color: #dc2626; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px;">HOT LEAD</span>';
                            }
                            if ($record->is_repeat ?? false) {
                                $badges[] = '<span style="background: #f3f4f6; color: #4b5563; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 600; letter-spacing: 0.5px;">REPEAT</span>';
                            }
                            return $badges ? '<div style="display: flex; gap: 8px; margin-bottom: 16px;">' . implode('', $badges) . '</div>' : '';
                        })
                        ->html(),

                    // Deal Summary Card
                    Section::make()
                        ->schema([
                            TextEntry::make('lead_id')
                                ->label('')
                                ->formatStateUsing(fn ($record) => 'Deal #' . ($record->id ?? '192748'))
                                ->extraAttributes(['style' => 'font-size: 13px; color: #6b7280;']),
                            
                            TextEntry::make('company')
                                ->label('')
                                ->default('TechCorp Project')
                                ->extraAttributes(['style' => 'font-size: 20px; font-weight: 700; color: #111827; line-height: 1.3;']),
                            
                            TextEntry::make('address')
                                ->label('')
                                ->default('2972 Washington Ave')
                                ->extraAttributes(['style' => 'font-size: 13px; color: #6b7280;']),
                            
                            TextEntry::make('action_buttons')
                                ->label('')
                                ->state(fn () => true)
                                ->formatStateUsing(fn () => '
                                    <div style="display: flex; gap: 8px; margin: 16px 0;">
                                        <button type="button" style="flex: 1; background: #10b981; color: white; border: none; padding: 10px 16px; border-radius: 6px; font-size: 14px; font-weight: 600; cursor: pointer;">
                                            + New Proposal
                                        </button>
                                        <button type="button" style="background: #f3f4f6; border: 1px solid #e5e7eb; padding: 10px 14px; border-radius: 6px; cursor: pointer;">📅</button>
                                        <button type="button" style="background: #f3f4f6; border: 1px solid #e5e7eb; padding: 10px 14px; border-radius: 6px; cursor: pointer;">⋯</button>
                                    </div>
                                ')
                                ->html(),
                            
                            TextEntry::make('proposal_total')
                                ->label('')
                                ->state(fn ($record) => true)
                                ->formatStateUsing(function ($state, $record) {
                                    $amount = '$12,500.00';
                                    return '
                                        <div style="border-top: 1px solid #e5e7eb; padding-top: 16px; margin-top: 16px;">
                                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                                <span style="font-size: 11px; font-weight: 600; color: #6b7280; letter-spacing: 0.5px;">PROPOSAL SENT</span>
                                                <a href="#" style="color: #10b981; font-size: 14px; font-weight: 600; text-decoration: none;">View</a>
                                            </div>
                                            <div style="font-size: 24px; font-weight: 700; color: #111827;">' . $amount . '</div>
                                        </div>
                                    ';
                                })
                                ->html(),
                        ])
                        ->columnSpanFull(),

                    // Contact Details Card
                    Section::make('Contact Details')
                        ->schema([
                            TextEntry::make('contact_info')
                                ->label('')
                                ->state(fn ($record) => true)
                                ->formatStateUsing(function ($state, $record) {
                                    $firstName = $record->first_name ?? 'Sarah';
                                    $lastName = $record->last_name ?? 'Wilson';
                                    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                                    $fullName = $firstName . ' ' . $lastName;
                                    
                                    return '
                                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                                            <div style="width: 40px; height: 40px; background: #fce7f3; color: #ec4899; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">
                                                ' . $initials . '
                                            </div>
                                            <div>
                                                <div style="font-weight: 600; color: #111827; font-size: 14px;">' . $fullName . '</div>
                                                <div style="font-size: 13px; color: #6b7280;">Primary Contact</div>
                                            </div>
                                        </div>
                                    ';
                                })
                                ->html(),
                            
                            TextEntry::make('email')
                                ->label('Email Address')
                                ->icon('heroicon-o-envelope')
                                ->default('sarah@techcorp.com'),
                            
                            TextEntry::make('phone')
                                ->label('Phone')
                                ->icon('heroicon-o-phone')
                                ->default('(555) 123-4567'),
                            
                            TextEntry::make('source')
                                ->label('Source')
                                ->icon('heroicon-o-globe-alt')
                                ->default('Website'),
                        ])
                        ->columnSpanFull(),

                    // Salesperson Card
                    Section::make('Salesperson')
                        ->schema([
                            TextEntry::make('assigned_user')
                                ->label('')
                                ->state(fn ($record) => true)
                                ->formatStateUsing(function ($state, $record) {
                                    $userName = 'John Doe';
                                    return '
                                        <div style="display: flex; align-items: center; gap: 12px;">
                                            <div style="width: 32px; height: 32px; background: #dbeafe; color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 12px;">
                                                JD
                                            </div>
                                            <div style="font-weight: 500; color: #111827; font-size: 14px;">' . $userName . '</div>
                                        </div>
                                    ';
                                })
                                ->html(),
                        ])
                        ->columnSpanFull(),
                ])
                ->columnSpan(4),

                // RIGHT CONTENT AREA (8 columns)
                Group::make([
                    // Pipeline Header
                    Section::make()
                        ->schema([
                            TextEntry::make('pipeline_header')
                                ->label('Pipeline header')
                                ->state(fn ($record) => $record)
                                ->formatStateUsing(function ($state, $record) {
                                    $currentStage = $record->stage ?? 'New Leads';
                                    $stages = [
                                        'New Leads',
                                        'Request Received',
                                        'In Draft',
                                        'Proposal Sent',
                                        'Approved',
                                        'Rejected'
                                    ];
                                    
                                    $currentIndex = array_search($currentStage, $stages);
                                    
                                    $stageHtml = '';
                                    foreach ($stages as $index => $stage) {
                                        $isActive = $stage === $currentStage;
                                        $isCompleted = $index < $currentIndex;
                                        
                                        // Styling based on state
                                        if ($isActive) {
                                            $bgColor = '#10b981';
                                            $textColor = 'white';
                                            $borderRadius = 'border-radius: 6px 0 0 6px;';
                                            if ($index === count($stages) - 1) {
                                                $borderRadius = 'border-radius: 0 6px 6px 0;';
                                            } elseif ($index > 0) {
                                                $borderRadius = 'border-radius: 0;';
                                            }
                                            $clipPath = 'clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%, 12px 50%);';
                                            if ($index === 0) {
                                                $clipPath = 'clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%);';
                                            }
                                            $checkmark = '✓';
                                        } elseif ($isCompleted) {
                                            $bgColor = '#d1fae5';
                                            $textColor = '#065f46';
                                            $borderRadius = '';
                                            $clipPath = 'clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%, 12px 50%);';
                                            if ($index === 0) {
                                                $clipPath = 'clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%);';
                                            }
                                            $checkmark = '✓';
                                        } else {
                                            $bgColor = '#f3f4f6';
                                            $textColor = '#6b7280';
                                            $borderRadius = '';
                                            $clipPath = '';
                                            if ($index > $currentIndex && $index < count($stages) - 1) {
                                                $clipPath = 'clip-path: polygon(0 0, calc(100% - 12px) 0, 100% 50%, calc(100% - 12px) 100%, 0 100%, 12px 50%);';
                                            } elseif ($index === count($stages) - 1) {
                                                $clipPath = 'clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%, 12px 50%);';
                                            }
                                            $checkmark = '';
                                        }
                                        
                                        $stageHtml .= '<div style="flex: 1; background: ' . $bgColor . '; color: ' . $textColor . '; padding: 12px 20px; text-align: center; font-size: 13px; font-weight: 500; position: relative; ' . $clipPath . ' display: flex; align-items: center; justify-content: center; gap: 6px;">';
                                        if ($checkmark) {
                                            $stageHtml .= '<span style="font-size: 14px;">' . $checkmark . '</span>';
                                        }
                                        $stageHtml .= '<span>' . $stage . '</span></div>';
                                    }
                                    
                                    return '
                                        <div>
                                            <div style="font-size: 13px; color: #6b7280; margin-bottom: 16px;">
                                                <span style="color: #111827; font-weight: 500;">Pipeline:</span> <span style="color: #10b981; font-weight: 500;">Deals Pipeline</span>
                                                <span style="margin: 0 8px; color: #d1d5db;">|</span>
                                                <span style="color: #111827; font-weight: 500;">Stage:</span> <span style="font-weight: 500;">' . $currentStage . '</span>
                                            </div>
                                            
                                            <div style="display: flex; margin-bottom: 20px; gap: 2px;">
                                                ' . $stageHtml . '
                                            </div>
                                            
                                            <div style="display: flex; gap: 16px;">
                                                <div style="flex: 1; padding: 16px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; gap: 12px;">
                                                    <svg style="width: 18px; height: 18px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                    </svg>
                                                    <div>
                                                        <div style="font-size: 12px; color: #6b7280;">Active sequence</div>
                                                        <div style="font-weight: 600; color: #111827; font-size: 14px;">Proposals Sequence</div>
                                                    </div>
                                                </div>
                                                <div style="flex: 1; padding: 16px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; gap: 12px;">
                                                    <svg style="width: 18px; height: 18px; color: #6b7280;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <div>
                                                        <div style="font-size: 12px; color: #6b7280;">Next drip</div>
                                                        <div style="font-weight: 600; color: #111827; font-size: 14px;">Follow up proposal</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';
                                })
                                ->html(),
                        ])
                        ->columnSpanFull(),


                    // Tabs
                    Tabs::make('lead_tabs')
                        ->tabs([
                            Tab::make('Activity')
                                ->schema([
                                    TextEntry::make('activity_content')
                                        ->label('')
                                        ->state(fn () => true)
                                        ->formatStateUsing(fn () => '
                                            <div>
                                                <h3 style="font-weight: 700; font-size: 16px; margin-bottom: 16px;">Latest Activity</h3>
                                                
                                                <div style="display: flex; gap: 12px; padding: 16px; background: #f9fafb; border-radius: 6px; margin-bottom: 12px;">
                                                    <div style="width: 32px; height: 32px; background: #d1fae5; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                        <span style="color: #10b981;">✉</span>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <div style="font-weight: 600; color: #111827; font-size: 14px; margin-bottom: 4px;">Email Delivered: Proposal Sent</div>
                                                        <div style="font-size: 13px; color: #6b7280;">Proposal has been sent the message to the customer\'s email.</div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #9ca3af; white-space: nowrap;">Today 9:45 AM</div>
                                                </div>
                                                
                                                <div style="display: flex; gap: 12px; padding: 16px; background: #f9fafb; border-radius: 6px;">
                                                    <div style="width: 32px; height: 32px; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                        <span style="color: #3b82f6;">→</span>
                                                    </div>
                                                    <div style="flex: 1;">
                                                        <div style="font-weight: 600; color: #111827; font-size: 14px; margin-bottom: 4px;">Stage: Request Received — Proposal Sent</div>
                                                        <div style="font-size: 13px; color: #6b7280;">Deal #192748 has been moved to the Proposal Sent stage.</div>
                                                    </div>
                                                    <div style="font-size: 12px; color: #9ca3af; white-space: nowrap;">Today 9:45 AM</div>
                                                </div>
                                                
                                                <div style="margin-top: 32px;">
                                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                                                        <div style="font-weight: 700; font-size: 16px; color: #111827;">Appointments</div>
                                                        <a href="#" style="color: #10b981; font-size: 14px; font-weight: 600; text-decoration: none;">+ Create appointment</a>
                                                    </div>
                                                    
                                                    <div style="display: flex; gap: 16px; padding: 16px; background: white; border: 1px solid #e5e7eb; border-radius: 6px;">
                                                        <div style="text-align: center; padding-right: 16px; border-right: 1px solid #e5e7eb;">
                                                            <div style="font-size: 11px; color: #6b7280; font-weight: 600;">MONDAY</div>
                                                            <div style="font-size: 20px; font-weight: 700; color: #111827; margin: 4px 0;">Jan 19</div>
                                                            <div style="font-size: 12px; color: #6b7280;">2024</div>
                                                        </div>
                                                        <div style="flex: 1;">
                                                            <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">10 AM - 10:30 AM</div>
                                                            <div style="display: flex; align-items: center; gap: 6px; margin-bottom: 8px;">
                                                                <span style="color: #10b981; font-size: 16px;">●</span>
                                                                <span style="font-weight: 600; color: #111827; font-size: 14px;">On-Site Estimate with John Doe</span>
                                                            </div>
                                                            <div style="display: flex; align-items: center; gap: 6px; font-size: 13px; color: #6b7280; margin-bottom: 4px;">
                                                                <span>📍</span>
                                                                <span>4517 Washington Avenue, Manchester, KY 39495</span>
                                                            </div>
                                                            <div style="display: flex; align-items: center; gap: 6px; font-size: 13px; color: #6b7280;">
                                                                <span>👤</span>
                                                                <span>Ahmad Fawaid</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" style="background: none; border: none; color: #9ca3af; font-size: 18px; cursor: pointer; padding: 0 8px;">⋯</button>
                                                    </div>
                                                </div>
                                                
                                                <div style="margin-top: 32px;">
                                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                                                        <div style="font-weight: 700; font-size: 16px; color: #111827;">Proposals</div>
                                                        <a href="#" style="color: #10b981; font-size: 14px; font-weight: 600; text-decoration: none;">+ Create proposal</a>
                                                    </div>
                                                    
                                                    <div style="background: white; border: 1px solid #e5e7eb; border-radius: 6px;">
                                                        <div style="display: flex; align-items: center; gap: 16px; padding: 16px; border-bottom: 1px solid #e5e7eb;">
                                                            <div style="width: 40px; height: 40px; background: #f0fdf4; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 20px;">
                                                                📄
                                                            </div>
                                                            <div style="flex: 1;">
                                                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                                                    <span style="color: #10b981; font-weight: 600; font-size: 14px;">#192783</span>
                                                                    <span style="color: #111827; font-weight: 600; font-size: 14px;">Enterprise Software Solution</span>
                                                                </div>
                                                                <div style="display: flex; gap: 24px; font-size: 13px;">
                                                                    <div>
                                                                        <span style="color: #6b7280;">Sent date</span>
                                                                        <div style="color: #111827; font-weight: 500;">Jan 18, 2024</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="text-align: right;">
                                                                <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Amount</div>
                                                                <div style="font-size: 18px; font-weight: 700; color: #111827;">$12,500.00</div>
                                                                <span style="background: #fef3c7; color: #92400e; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600;">PENDING</span>
                                                            </div>
                                                            <button type="button" style="background: none; border: none; color: #9ca3af; font-size: 18px; cursor: pointer;">⋯</button>
                                                        </div>
                                                        <div style="padding: 12px 16px; background: #fafafa;">
                                                            <div style="display: flex; gap: 24px; font-size: 13px;">
                                                                <div>
                                                                    <span style="color: #6b7280;">Accepted Date</span>
                                                                    <div style="color: #111827;">-</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ')
                                        ->html(),
                                ]),
                            
                            Tab::make('Appointments')
                                ->badge(1)
                                ->schema([
                                    TextEntry::make('appointments_tab')
                                        ->label('')
                                        ->state(fn () => 'Appointment details would appear here')
                                        ->extraAttributes(['style' => 'padding: 20px; color: #6b7280;']),
                                ]),
                            
                            Tab::make('Proposals')
                                ->badge(1)
                                ->schema([
                                    TextEntry::make('proposals_tab')
                                        ->label('')
                                        ->state(fn () => 'Proposal details would appear here')
                                        ->extraAttributes(['style' => 'padding: 20px; color: #6b7280;']),
                                ]),
                            
                                Tab::make('Invoices')
                                ->schema([
                                    TextEntry::make('invoices_tab')
                                        ->label('')
                                        ->state(fn () => true)
                                        ->formatStateUsing(fn () => '
                                            <div style="text-align: center; padding: 60px 20px;">
                                                <div style="font-size: 15px; color: #6b7280; margin-bottom: 16px;">No invoices yet</div>
                                                <button type="button" style="background: white; border: 1px solid #d1d5db; color: #374151; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer;">
                                                    + Create Invoice
                                                </button>
                                            </div>
                                        ')
                                        ->html(),
                                ]),
                            
                            Tab::make('Notifications')
                                ->schema([
                                    TextEntry::make('notifications_tab')
                                        ->label('')
                                        ->state(fn () => 'No notifications')
                                        ->extraAttributes(['style' => 'padding: 20px; color: #6b7280;']),
                                ]),
                            
                            Tab::make('Notes')
                                ->schema([
                                    TextEntry::make('notes_tab')
                                        ->label('')
                                        ->state(fn () => 'No notes')
                                        ->extraAttributes(['style' => 'padding: 20px; color: #6b7280;']),
                                ]),
                            
                            Tab::make('Tasks')
                                ->schema([
                                    TextEntry::make('tasks_tab')
                                        ->label('')
                                        ->state(fn () => 'No tasks')
                                        ->extraAttributes(['style' => 'padding: 20px; color: #6b7280;']),
                                ]),
                        ])
                        ->columnSpanFull(),
                ])
                ->columnSpan(8),
            ])
            ->columns(12)
            ->columnSpanFull(),
        ]);
    }
}