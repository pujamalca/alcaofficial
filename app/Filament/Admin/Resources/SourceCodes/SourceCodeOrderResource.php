<?php

namespace App\Filament\Admin\Resources\SourceCodes;

use App\Filament\Admin\Resources\SourceCodes\Pages\CreateSourceCodeOrder;
use App\Filament\Admin\Resources\SourceCodes\Pages\EditSourceCodeOrder;
use App\Filament\Admin\Resources\SourceCodes\Pages\ListSourceCodeOrders;
use App\Filament\Admin\Resources\SourceCodes\Schemas\SourceCodeOrderForm;
use App\Filament\Admin\Resources\SourceCodes\Tables\SourceCodeOrdersTable;
use App\Models\SourceCodeOrder;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SourceCodeOrderResource extends Resource
{
    protected static ?string $model = SourceCodeOrder::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?int $navigationSort = 33;

    public static function form(Schema $schema): Schema
    {
        return SourceCodeOrderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SourceCodeOrdersTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Source Code';
    }

    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'orders';
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        $pendingCount = static::getModel()::where('status', 'pending')->count();
        return $pendingCount > 0 ? 'warning' : 'success';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSourceCodeOrders::route('/'),
            'create' => CreateSourceCodeOrder::route('/create'),
            'edit' => EditSourceCodeOrder::route('/{record}/edit'),
        ];
    }
}
