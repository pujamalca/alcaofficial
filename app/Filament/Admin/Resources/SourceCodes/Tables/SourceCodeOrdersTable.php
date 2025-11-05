<?php

namespace App\Filament\Admin\Resources\SourceCodes\Tables;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeOrderResource;
use App\Models\SourceCodeOrder;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Support\Enums\IconPosition;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class SourceCodeOrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (SourceCodeOrder $record): string => SourceCodeOrderResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('order_number')
                    ->label('No. Order')
                    ->searchable()
                    ->sortable()
                    ->weight('medium')
                    ->copyable()
                    ->copyMessage('Order number copied'),
                TextColumn::make('sourceCode.title')
                    ->label('Source Code')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                TextColumn::make('customer_name')
                    ->label('Pelanggan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('customer_email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable()
                    ->copyable(),
                TextColumn::make('amount')
                    ->label('Jumlah')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('payment_status')
                    ->label('Pembayaran')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'gray',
                        default => 'gray',
                    }),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('download_count')
                    ->label('Download')
                    ->formatStateUsing(fn (SourceCodeOrder $record): string =>
                        "{$record->download_count} / {$record->max_downloads}"
                    )
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_expired')
                    ->label('Expired')
                    ->boolean()
                    ->trueIcon('heroicon-o-x-circle')
                    ->falseIcon('heroicon-o-check-circle')
                    ->trueColor('danger')
                    ->falseColor('success')
                    ->toggleable(),
                ImageColumn::make('payment_proof')
                    ->label('Bukti')
                    ->disk('public')
                    ->height(40)
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Order')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Order')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    ]),
                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ]),
            ])
            ->actions([
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (SourceCodeOrder $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('admin_notes')
                            ->label('Catatan Admin (Opsional)')
                            ->rows(3),
                    ])
                    ->action(function (SourceCodeOrder $record, array $data): void {
                        $record->approve(Auth::user(), $data['admin_notes'] ?? null);

                        Notification::make()
                            ->success()
                            ->title('Order Approved')
                            ->body("Order {$record->order_number} telah diapprove")
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (SourceCodeOrder $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('admin_notes')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(function (SourceCodeOrder $record, array $data): void {
                        $record->reject($data['admin_notes']);

                        Notification::make()
                            ->danger()
                            ->title('Order Rejected')
                            ->body("Order {$record->order_number} telah ditolak")
                            ->send();
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
