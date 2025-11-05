<?php

namespace App\Filament\Admin\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Testimoni')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('role')
                        ->label('Jabatan / Perusahaan')
                        ->maxLength(150),
                    TextInput::make('rating')
                        ->label('Rating')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(5)
                        ->step(0.1)
                        ->default(5),
                    Textarea::make('quote')
                        ->label('Testimoni')
                        ->rows(5)
                        ->required(),
                    FileUpload::make('avatar')
                        ->label('Foto / Avatar')
                        ->image()
                        ->directory('testimonials')
                        ->imageEditor()
                        ->imagePreviewHeight('150'),
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
