<?php

namespace App\Filament\Admin\Resources\Portfolio;

use App\Filament\Admin\Resources\Portfolio\Pages\CreatePortfolioItem;
use App\Filament\Admin\Resources\Portfolio\Pages\EditPortfolioItem;
use App\Filament\Admin\Resources\Portfolio\Pages\ListPortfolioItems;
use App\Filament\Admin\Resources\Portfolio\Schemas\PortfolioItemForm;
use App\Filament\Admin\Resources\Portfolio\Tables\PortfolioItemsTable;
use App\Models\PortfolioItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PortfolioItemResource extends Resource
{
    protected static ?string $model = PortfolioItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static ?string $navigationLabel = 'Portofolio';

    protected static ?int $navigationSort = 21;

    public static function form(Schema $schema): Schema
    {
        return PortfolioItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PortfolioItemsTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPortfolioItems::route('/'),
            'create' => CreatePortfolioItem::route('/create'),
            'edit' => EditPortfolioItem::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage-portfolio') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage-portfolio') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage-portfolio') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage-portfolio') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage-portfolio') ?? false;
    }
}
