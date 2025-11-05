<?php

namespace App\Filament\Admin\Resources\Contacts\Tables;

use App\Filament\Admin\Resources\Contacts\ContactCardResource;
use App\Models\ContactCard;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactCardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (ContactCard $record): string => ContactCardResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('value')
                    ->label('Konten')
                    ->wrap(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')->label('Status')->boolean(),
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
