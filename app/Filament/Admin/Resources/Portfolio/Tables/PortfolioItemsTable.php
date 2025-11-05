<?php

namespace App\Filament\Admin\Resources\Portfolio\Tables;

use App\Filament\Admin\Resources\Portfolio\PortfolioItemResource;
use App\Models\PortfolioItem;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PortfolioItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (PortfolioItem $record): string => PortfolioItemResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state >= 4 ? 'success' : ($state >= 3 ? 'warning' : 'danger')),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
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
                    ]),
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
