<?php

namespace App\Filament\Admin\Resources\SourceCodes;

use App\Filament\Admin\Resources\SourceCodes\Pages\CreateSourceCode;
use App\Filament\Admin\Resources\SourceCodes\Pages\EditSourceCode;
use App\Filament\Admin\Resources\SourceCodes\Pages\ListSourceCodes;
use App\Filament\Admin\Resources\SourceCodes\Schemas\SourceCodeForm;
use App\Filament\Admin\Resources\SourceCodes\Tables\SourceCodesTable;
use App\Models\SourceCode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SourceCodeResource extends Resource
{
    protected static ?string $model = SourceCode::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';

    protected static ?string $navigationLabel = 'Source Code';

    protected static ?int $navigationSort = 32;

    public static function form(Schema $schema): Schema
    {
        return SourceCodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SourceCodesTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Source Code';
    }

    public static function getSlug(?\Filament\Panel $panel = null): string
    {
        return 'source-codes';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSourceCodes::route('/'),
            'create' => CreateSourceCode::route('/create'),
            'edit' => EditSourceCode::route('/{record}/edit'),
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
