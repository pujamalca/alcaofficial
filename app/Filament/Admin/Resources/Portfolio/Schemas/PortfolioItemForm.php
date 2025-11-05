<?php

namespace App\Filament\Admin\Resources\Portfolio\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PortfolioItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Portfolio')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->label('Judul')
                        ->required()
                        ->maxLength(255),
                    Select::make('category')
                        ->label('Kategori')
                        ->options([
                            'Web Development' => 'Web Development',
                            'Mobile App' => 'Mobile App',
                            'UI/UX Design' => 'UI/UX Design',
                            'Branding & Identity' => 'Branding & Identity',
                            'E-Commerce' => 'E-Commerce',
                            'Landing Page' => 'Landing Page',
                            'Dashboard & CMS' => 'Dashboard & CMS',
                            'System Integration' => 'System Integration',
                        ])
                        ->required()
                        ->searchable()
                        ->placeholder('Pilih kategori portfolio'),
                    Textarea::make('description')
                        ->label('Deskripsi / Penjelasan')
                        ->rows(4),
                    TextInput::make('url')
                        ->label('Link Portfolio')
                        ->url()
                        ->placeholder('https://example.com')
                        ->helperText('Link untuk mengecek portfolio secara langsung')
                        ->maxLength(255),
                    TextInput::make('rating')
                        ->label('Rating')
                        ->numeric()
                        ->minValue(0)
                        ->maxValue(5)
                        ->step(0.1)
                        ->default(5),
                    Repeater::make('images')
                        ->label('Gambar Portfolio')
                        ->schema([
                            FileUpload::make('image')
                                ->label('Gambar')
                                ->image()
                                ->disk('public')
                                ->directory('portfolio')
                                ->imageEditor()
                                ->imagePreviewHeight('200')
                                ->required(),
                        ])
                        ->defaultItems(1)
                        ->addActionLabel('Tambah Gambar')
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => 'Gambar ' . ($state ? '' : ''))
                        ->columnSpanFull()
                        ->minItems(1),
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
