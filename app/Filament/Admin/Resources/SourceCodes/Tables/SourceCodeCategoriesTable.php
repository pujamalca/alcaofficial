<?php

namespace App\Filament\Admin\Resources\SourceCodes\Tables;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeCategoryResource;
use App\Models\SourceCodeCategory;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class SourceCodeCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (SourceCodeCategory $record): string => SourceCodeCategoryResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                ColorColumn::make('color')
                    ->label('Warna')
                    ->toggleable(),
                TextColumn::make('icon')
                    ->label('Icon')
                    ->toggleable(),
                TextColumn::make('sourceCodes_count')
                    ->label('Jumlah Source Code')
                    ->counts('sourceCodes')
                    ->badge()
                    ->color('info'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Status')
                    ->boolean(),
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
