<?php

namespace App\Filament\Admin\Resources\Services\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Layanan')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('icon')
                        ->label('Heroicon (opsional)')
                        ->placeholder('heroicon-o-globe-alt')
                        ->helperText('Gunakan nama komponen Heroicon, contoh: heroicon-o-rocket-launch'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4),
                    Repeater::make('features')
                        ->label('Fitur Layanan')
                        ->schema([
                            TextInput::make('feature')
                                ->label('Nama Fitur')
                                ->required()
                                ->placeholder('Contoh: Payment Gateway Integration')
                                ->maxLength(255),
                        ])
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Fitur')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['feature'] ?? null)
                        ->columnSpanFull(),
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
