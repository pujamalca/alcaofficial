<?php

namespace App\Filament\Admin\Resources\Services\Tables;

use App\Filament\Admin\Resources\Services\ServiceResource;
use App\Models\Service;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (Service $record): string => ServiceResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('icon')
                    ->label('Icon')
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Aktif'),
                TextColumn::make('updated_at')
                    ->dateTime('d M Y H:i')
                    ->label('Diperbarui')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
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
