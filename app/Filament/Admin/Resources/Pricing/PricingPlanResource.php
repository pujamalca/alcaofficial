<?php

namespace App\Filament\Admin\Resources\Pricing;

use App\Filament\Admin\Resources\Pricing\Pages\CreatePricingPlan;
use App\Filament\Admin\Resources\Pricing\Pages\EditPricingPlan;
use App\Filament\Admin\Resources\Pricing\Pages\ListPricingPlans;
use App\Models\PricingPlan;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables;
use Filament\Tables\Table;
use BackedEnum;
use UnitEnum;

class PricingPlanResource extends Resource
{
    protected static ?string $model = PricingPlan::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static UnitEnum|string|null $navigationGroup = 'Website';

    protected static ?string $navigationLabel = 'Harga';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Paket')
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Paket')
                        ->required()
                        ->maxLength(150),
                    TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->maxLength(50),
                    TextInput::make('price_suffix')
                        ->label('Informasi Harga')
                        ->maxLength(100),
                    TextInput::make('badge')
                        ->label('Badge')
                        ->maxLength(50)
                        ->helperText('Contoh: Terpopuler, Hemat'),
                    Toggle::make('is_featured')
                        ->label('Tandai sebagai unggulan'),
                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(4),
                    TextInput::make('cta_text')
                        ->label('Teks Tombol')
                        ->maxLength(100),
                    TextInput::make('cta_url')
                        ->label('URL Tombol')
                        ->maxLength(255)
                        ->placeholder('#kontak'),
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Harga'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status')->boolean(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPricingPlans::route('/'),
            'create' => CreatePricingPlan::route('/create'),
            'edit' => EditPricingPlan::route('/{record}/edit'),
        ];
    }
}
