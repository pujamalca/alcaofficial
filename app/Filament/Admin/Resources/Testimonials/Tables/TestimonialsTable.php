<?php

namespace App\Filament\Admin\Resources\Testimonials\Tables;

use App\Filament\Admin\Resources\Testimonials\TestimonialResource;
use App\Models\Testimonial;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->recordUrl(fn (Testimonial $record): string => TestimonialResource::getUrl('edit', ['record' => $record]))
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Jabatan')
                    ->toggleable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable(),
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
