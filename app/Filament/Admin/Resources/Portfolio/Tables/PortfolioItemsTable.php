<?php

namespace App\Filament\Admin\Resources\Portfolio\Tables;

use App\Filament\Admin\Resources\Portfolio\PortfolioItemResource;
use App\Models\PortfolioItem;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
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
                ImageColumn::make('header_image')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->size(60)
                    ->circular(),
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
                        // Web Platform
                        'Web Application' => 'Web Application',
                        'Website Company Profile' => 'Website Company Profile',
                        'E-Commerce Website' => 'E-Commerce Website',
                        'Landing Page' => 'Landing Page',
                        'Dashboard & CMS' => 'Dashboard & CMS',
                        'Web Portal' => 'Web Portal',

                        // Mobile Platform
                        'Mobile App (Android)' => 'Mobile App (Android)',
                        'Mobile App (iOS)' => 'Mobile App (iOS)',
                        'Mobile App (Hybrid)' => 'Mobile App (Hybrid)',

                        // Desktop Platform
                        'Desktop App (Windows)' => 'Desktop App (Windows)',
                        'Desktop App (macOS)' => 'Desktop App (macOS)',
                        'Desktop App (Linux)' => 'Desktop App (Linux)',
                        'Desktop App (Cross-Platform)' => 'Desktop App (Cross-Platform)',

                        // Design & Creative
                        'UI/UX Design' => 'UI/UX Design',
                        'Branding & Identity' => 'Branding & Identity',
                        'Graphic Design' => 'Graphic Design',

                        // Development Services
                        'API Development' => 'API Development',
                        'System Integration' => 'System Integration',
                        'Plugin/Extension' => 'Plugin/Extension',
                        'SaaS Application' => 'SaaS Application',

                        // Specialized
                        'Game Development' => 'Game Development',
                        'IoT Application' => 'IoT Application',
                        'Blockchain/Web3' => 'Blockchain/Web3',
                        'AI/Machine Learning' => 'AI/Machine Learning',
                    ])
                    ->searchable(),
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
