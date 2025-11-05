<?php

namespace App\Filament\Admin\Resources\SourceCodes;

use App\Filament\Admin\Resources\SourceCodes\Pages\CreateSourceCodeCategory;
use App\Filament\Admin\Resources\SourceCodes\Pages\EditSourceCodeCategory;
use App\Filament\Admin\Resources\SourceCodes\Pages\ListSourceCodeCategories;
use App\Filament\Admin\Resources\SourceCodes\Schemas\SourceCodeCategoryForm;
use App\Filament\Admin\Resources\SourceCodes\Tables\SourceCodeCategoriesTable;
use App\Models\SourceCodeCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SourceCodeCategoryResource extends Resource
{
    protected static ?string $model = SourceCodeCategory::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationLabel = 'Kategori Source Code';

    protected static ?int $navigationSort = 31;

    public static function form(Schema $schema): Schema
    {
        return SourceCodeCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SourceCodeCategoriesTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Source Code';
    }

    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'source-code-categories';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSourceCodeCategories::route('/'),
            'create' => CreateSourceCodeCategory::route('/create'),
            'edit' => EditSourceCodeCategory::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage-source-codes') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage-source-codes') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage-source-codes') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage-source-codes') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage-source-codes') ?? false;
    }
}
