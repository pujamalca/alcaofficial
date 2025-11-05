<?php

namespace App\Filament\Admin\Resources\Pricing\Tables;

use App\Filament\Admin\Resources\Pricing\PricingPlanResource;
use App\Models\PricingPlan;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PricingPlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (PricingPlan $record): string => PricingPlanResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga'),
                IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),
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
