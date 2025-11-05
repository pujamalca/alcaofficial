<?php

namespace App\Filament\Admin\Resources\SourceCodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SourceCodeOrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Order')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('order_number')
                        ->label('Nomor Order')
                        ->disabled()
                        ->dehydrated()
                        ->helperText('Generate otomatis'),
                    Select::make('user_id')
                        ->label('User (Opsional)')
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->helperText('Jika order dari user terdaftar'),
                    Select::make('source_code_id')
                        ->label('Source Code')
                        ->relationship('sourceCode', 'title')
                        ->required()
                        ->searchable()
                        ->preload(),
                ])
                ->columns(3),

            Section::make('Informasi Pelanggan')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('customer_name')
                        ->label('Nama Pelanggan')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('customer_email')
                        ->label('Email Pelanggan')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('customer_phone')
                        ->label('No. Telepon')
                        ->tel()
                        ->maxLength(20),
                    Textarea::make('notes')
                        ->label('Catatan Pelanggan')
                        ->rows(2)
                        ->columnSpanFull(),
                ])
                ->columns(3),

            Section::make('Informasi Pembayaran')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('amount')
                        ->label('Jumlah')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->helperText('Jumlah pembayaran'),
                    Select::make('payment_status')
                        ->label('Status Pembayaran')
                        ->options([
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'failed' => 'Failed',
                            'refunded' => 'Refunded',
                        ])
                        ->required()
                        ->default('pending'),
                    Select::make('payment_method')
                        ->label('Metode Pembayaran')
                        ->options([
                            'manual_transfer' => 'Transfer Manual',
                            'ewallet' => 'E-Wallet',
                            'credit_card' => 'Kartu Kredit',
                            'other' => 'Lainnya',
                        ]),
                    FileUpload::make('payment_proof')
                        ->label('Bukti Pembayaran')
                        ->disk('public')
                        ->directory('payment-proofs')
                        ->image()
                        ->imageEditor()
                        ->maxSize(5120)
                        ->helperText('Upload bukti transfer (max 5MB)')
                        ->columnSpan(2),
                    DateTimePicker::make('paid_at')
                        ->label('Tanggal Pembayaran')
                        ->helperText('Tanggal pelanggan melakukan pembayaran'),
                ])
                ->columns(3),

            Section::make('Status & Akses Download')
                ->columnSpanFull()
                ->schema([
                    Select::make('status')
                        ->label('Status Order')
                        ->options([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'completed' => 'Completed',
                        ])
                        ->required()
                        ->default('pending')
                        ->helperText('Approved = customer dapat download'),
                    TextInput::make('max_downloads')
                        ->label('Maksimal Download')
                        ->numeric()
                        ->default(3)
                        ->helperText('Jumlah maksimal download yang diizinkan'),
                    DateTimePicker::make('expires_at')
                        ->label('Tanggal Kadaluarsa')
                        ->helperText('Download token akan expire pada tanggal ini'),
                    Placeholder::make('download_info')
                        ->label('Info Download')
                        ->content(function ($record): string {
                            if (!$record) {
                                return 'Belum ada order';
                            }

                            $info = "Download: {$record->download_count} / {$record->max_downloads}\n";

                            if ($record->download_token) {
                                $info .= "Token: {$record->download_token}\n";
                            }

                            if ($record->expires_at) {
                                $expired = $record->is_expired ? ' (EXPIRED)' : '';
                                $info .= "Expires: {$record->expires_at->format('d/m/Y H:i')}{$expired}\n";
                            }

                            return $info;
                        })
                        ->columnSpan(3),
                ])
                ->columns(3),

            Section::make('Catatan Admin')
                ->columnSpanFull()
                ->schema([
                    Textarea::make('admin_notes')
                        ->label('Catatan Admin')
                        ->rows(3)
                        ->helperText('Catatan internal untuk admin')
                        ->columnSpanFull(),
                    DateTimePicker::make('approved_at')
                        ->label('Tanggal Approval')
                        ->disabled()
                        ->dehydrated(),
                    Select::make('approved_by')
                        ->label('Diapprove Oleh')
                        ->relationship('approvedBy', 'name')
                        ->disabled()
                        ->dehydrated(),
                ])
                ->columns(2),

            Section::make('Informasi Sistem')
                ->columnSpanFull()
                ->schema([
                    Placeholder::make('created_at')
                        ->label('Dibuat')
                        ->content(fn ($record): string => $record?->created_at?->format('d/m/Y H:i') ?? '-'),
                    Placeholder::make('updated_at')
                        ->label('Diupdate')
                        ->content(fn ($record): string => $record?->updated_at?->format('d/m/Y H:i') ?? '-'),
                ])
                ->columns(2),
        ]);
    }
}
