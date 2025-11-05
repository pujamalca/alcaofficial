<?php

namespace App\Filament\Admin\Resources\SourceCodes\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SourceCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Dasar')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('title')
                        ->label('Judul Source Code')
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
                        ->helperText('URL-friendly version (otomatis dari judul)'),
                    Select::make('category_id')
                        ->label('Kategori')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->label('Nama Kategori')
                                ->required(),
                            TextInput::make('slug')
                                ->label('Slug')
                                ->required(),
                        ]),
                    Textarea::make('short_description')
                        ->label('Deskripsi Singkat')
                        ->rows(2)
                        ->maxLength(500)
                        ->helperText('Deskripsi singkat untuk preview (max 500 karakter)')
                        ->columnSpanFull(),
                    MarkdownEditor::make('description')
                        ->label('Deskripsi Lengkap')
                        ->required()
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'link',
                            'bulletList',
                            'orderedList',
                            'codeBlock',
                            'heading',
                        ]),
                ])
                ->columns(2),

            Section::make('Harga & Pembayaran')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('price')
                        ->label('Harga Normal')
                        ->required()
                        ->numeric()
                        ->prefix('Rp')
                        ->helperText('Harga dalam Rupiah'),
                    TextInput::make('discount_price')
                        ->label('Harga Diskon')
                        ->numeric()
                        ->prefix('Rp')
                        ->helperText('Opsional: Harga setelah diskon')
                        ->lte('price'),
                    TextInput::make('currency')
                        ->label('Mata Uang')
                        ->default('IDR')
                        ->maxLength(3)
                        ->disabled()
                        ->dehydrated(),
                ])
                ->columns(3),

            Section::make('Upload Source Code')
                ->columnSpanFull()
                ->schema([
                    Radio::make('upload_type')
                        ->label('Metode Upload')
                        ->required()
                        ->options([
                            'file' => 'Upload File ZIP',
                            'external_link' => 'Link Eksternal (Google Drive, GitHub, dll)',
                        ])
                        ->default('file')
                        ->live()
                        ->columnSpanFull(),
                    FileUpload::make('file_path')
                        ->label('File Source Code')
                        ->disk('public')
                        ->directory('source-codes')
                        ->acceptedFileTypes(['application/zip', 'application/x-zip-compressed'])
                        ->maxSize(102400) // 100MB
                        ->visible(fn ($get): bool => $get('upload_type') === 'file')
                        ->helperText('Upload file ZIP (max 100MB)')
                        ->columnSpanFull(),
                    TextInput::make('external_link')
                        ->label('Link Eksternal')
                        ->url()
                        ->visible(fn ($get): bool => $get('upload_type') === 'external_link')
                        ->helperText('Link ke Google Drive, GitHub, atau platform lainnya')
                        ->columnSpanFull(),
                ])
                ->columns(1),

            Section::make('Media & Preview')
                ->columnSpanFull()
                ->schema([
                    FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->disk('public')
                        ->directory('source-codes/thumbnails')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                            '4:3',
                        ])
                        ->maxSize(5120) // 5MB
                        ->helperText('Gambar utama untuk preview (max 5MB)')
                        ->columnSpanFull(),
                    Repeater::make('preview_images')
                        ->label('Screenshot / Gambar Preview')
                        ->simple(
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('source-codes/previews')
                                ->image()
                                ->imageEditor()
                                ->maxSize(5120)
                        )
                        ->helperText('Upload beberapa screenshot untuk showcase')
                        ->columnSpanFull()
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Gambar'),
                ])
                ->columns(1),

            Section::make('Informasi Teknis')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('demo_link')
                        ->label('Link Demo')
                        ->url()
                        ->helperText('Link ke demo live (opsional)'),
                    TextInput::make('documentation_link')
                        ->label('Link Dokumentasi')
                        ->url()
                        ->helperText('Link ke dokumentasi (opsional)'),
                    TextInput::make('version')
                        ->label('Versi')
                        ->default('1.0.0')
                        ->helperText('Versi source code'),
                    TagsInput::make('tech_stack')
                        ->label('Teknologi / Stack')
                        ->helperText('Contoh: Laravel, Vue.js, MySQL, Tailwind CSS')
                        ->placeholder('Ketik dan tekan Enter')
                        ->columnSpanFull(),
                    Repeater::make('features')
                        ->label('Fitur-fitur Utama')
                        ->simple(
                            TextInput::make('feature')
                                ->label('Fitur')
                                ->required()
                        )
                        ->columnSpanFull()
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Fitur')
                        ->helperText('Daftar fitur-fitur utama dari source code'),
                    Textarea::make('requirements')
                        ->label('Requirements / Persyaratan')
                        ->rows(3)
                        ->helperText('Contoh: PHP 8.2+, MySQL 5.7+, Composer, Node.js')
                        ->columnSpanFull(),
                ])
                ->columns(3),

            Section::make('SEO & Meta')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('meta_title')
                        ->label('Meta Title')
                        ->maxLength(60)
                        ->helperText('Untuk SEO (max 60 karakter, opsional)'),
                    Textarea::make('meta_description')
                        ->label('Meta Description')
                        ->rows(2)
                        ->maxLength(160)
                        ->helperText('Untuk SEO (max 160 karakter, opsional)')
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->collapsed(),

            Section::make('Pengaturan')
                ->columnSpanFull()
                ->schema([
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0)
                        ->helperText('Urutan tampilan (semakin kecil semakin awal)'),
                    Toggle::make('is_active')
                        ->label('Aktif')
                        ->default(true)
                        ->helperText('Source code aktif dan dapat dibeli'),
                    Toggle::make('is_featured')
                        ->label('Featured')
                        ->default(false)
                        ->helperText('Tampilkan di halaman utama sebagai featured'),
                ])
                ->columns(3),
        ]);
    }
}
