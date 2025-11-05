<?php

namespace App\Filament\Admin\Resources\SourceCodes\Tables;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeResource;
use App\Models\SourceCode;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SourceCodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (SourceCode $record): string => SourceCodeResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->height(50)
                    ->defaultImageUrl(url('/images/placeholder.png')),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('medium'),
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (SourceCode $record): string => $record->category?->color ?? 'gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable()
                    ->description(fn (SourceCode $record): ?string =>
                        $record->has_discount
                            ? 'Diskon: ' . number_format($record->discount_price, 0, ',', '.') . ' (-' . $record->discount_percentage . '%)'
                            : null
                    ),
                TextColumn::make('upload_type')
                    ->label('Metode')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'file' => 'File ZIP',
                        'external_link' => 'Link Eksternal',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'file' => 'success',
                        'external_link' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('downloads_count')
                    ->label('Download')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('views_count')
                    ->label('Views')
                    ->badge()
                    ->color('info')
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-star')
                    ->trueColor('warning')
                    ->falseColor('gray'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload(),
                TernaryFilter::make('is_active')
                    ->label('Status Aktif')
                    ->boolean()
                    ->trueLabel('Hanya yang Aktif')
                    ->falseLabel('Hanya yang Non-aktif')
                    ->placeholder('Semua'),
                TernaryFilter::make('is_featured')
                    ->label('Featured')
                    ->boolean()
                    ->trueLabel('Hanya Featured')
                    ->falseLabel('Hanya Non-featured')
                    ->placeholder('Semua'),
                SelectFilter::make('upload_type')
                    ->label('Metode Upload')
                    ->options([
                        'file' => 'File ZIP',
                        'external_link' => 'Link Eksternal',
                    ]),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }
}
