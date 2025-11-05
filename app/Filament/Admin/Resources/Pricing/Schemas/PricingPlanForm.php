<?php

namespace App\Filament\Admin\Resources\Pricing\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PricingPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Paket')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Paket')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->maxLength(50),
                    TextInput::make('price_suffix')
                        ->label('Informasi Harga')
                        ->maxLength(100),
                    TextInput::make('badge')
                        ->label('Badge')
                        ->maxLength(50)
                        ->helperText('Contoh: Terpopuler, Hemat'),
                    Toggle::make('is_featured')
                        ->label('Tandai sebagai unggulan'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4),
                    TextInput::make('cta_text')
                        ->label('Teks Tombol')
                        ->maxLength(100),
                    TextInput::make('cta_url')
                        ->label('URL Tombol')
                        ->maxLength(255)
                        ->placeholder('#kontak'),
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Tampilkan')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }
}
