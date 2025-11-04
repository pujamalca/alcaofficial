<?php

namespace App\Filament\Admin\Resources\Portfolio\RelationManagers;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\HasManyRelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Portofolio';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    TextInput::make('title')
                        ->label('Judul Proyek')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('category')
                        ->label('Kategori')
                        ->maxLength(100),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4),
                    TextInput::make('url')
                        ->label('URL Proyek')
                        ->url()
                        ->maxLength(255),
                    FileUpload::make('image')
                        ->label('Gambar')
                        ->directory('portfolio')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('180'),
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
