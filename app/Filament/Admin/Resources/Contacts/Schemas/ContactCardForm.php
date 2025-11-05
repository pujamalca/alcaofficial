<?php

namespace App\Filament\Admin\Resources\Contacts\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactCardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kontak')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('value')
                        ->label('Konten')
                        ->maxLength(150),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3),
                    TextInput::make('icon')
                        ->label('Heroicon')
                        ->placeholder('heroicon-o-phone-arrow-up-right'),
                    TextInput::make('link')
                        ->label('URL / Aksi')
                        ->maxLength(255),
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                    Toggle::make('is_active')
                        ->label('Tampilkan')
                        ->default(true),
                ])
                ->columns(1),
        ]);
    }
}
