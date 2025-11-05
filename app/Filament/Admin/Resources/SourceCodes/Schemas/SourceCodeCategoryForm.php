<?php

namespace App\Filament\Admin\Resources\SourceCodes\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SourceCodeCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kategori')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Kategori')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($state, callable $set) {
                            if (! $state) {
                                return;
                            }
                            $set('slug', \Illuminate\Support\Str::slug($state));
                        }),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('URL-friendly version (otomatis dari nama)'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->columnSpanFull(),
                    TextInput::make('icon')
                        ->label('Icon (FontAwesome/Heroicon)')
                        ->placeholder('heroicon-o-code-bracket atau fas fa-code')
                        ->helperText('Contoh: heroicon-o-code-bracket, fas fa-code'),
                    ColorPicker::make('color')
                        ->label('Warna')
                        ->helperText('Warna untuk badge kategori'),
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true),
                ])
                ->columns(2),
        ]);
    }
}
