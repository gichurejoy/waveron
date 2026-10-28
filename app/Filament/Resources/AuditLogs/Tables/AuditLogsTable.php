<?php

namespace App\Filament\Resources\AuditLogs\Tables;

use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\AuditLog;

class AuditLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('M d, Y H:i:s')
                    ->sortable(),
                TextColumn::make('user_email')
                    ->label('User / Trigger')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('action')
                    ->label('Action')
                    ->badge()
                    ->color('info')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('entity_type')
                    ->label('Entity Type')
                    ->searchable(),
                TextColumn::make('entity_id')
                    ->label('Entity ID')
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Action::make('exportCsv')
                    ->label('Export Audit Logs (CSV)')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function () {
                        $logs = AuditLog::orderBy('created_at', 'desc')->get();
                        $headers = [
                            "Content-type"        => "text/csv",
                            "Content-Disposition" => "attachment; filename=audit_logs_" . date('Y-m-d') . ".csv",
                            "Pragma"              => "no-cache",
                            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                            "Expires"             => "0"
                        ];

                        $callback = function () use ($logs) {
                            $file = fopen('php://output', 'w');
                            fputcsv($file, ['Timestamp', 'User Email', 'Action', 'Entity Type', 'Entity ID', 'Description', 'IP Address']);

                            foreach ($logs as $log) {
                                fputcsv($file, [
                                    $log->created_at->format('Y-m-d H:i:s'),
                                    $log->user_email,
                                    $log->action,
                                    $log->entity_type,
                                    $log->entity_id,
                                    $log->description,
                                    $log->ip_address,
                                ]);
                            }

                            fclose($file);
                        };

                        return response()->streamDownload($callback, 'audit_logs_' . date('Y-m-d') . '.csv', $headers);
                    }),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
