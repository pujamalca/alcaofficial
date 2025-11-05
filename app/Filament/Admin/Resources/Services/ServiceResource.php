<?php

namespace App\Filament\Admin\Resources\Services;

use App\Filament\Admin\Resources\Services\Pages\CreateService;
use App\Filament\Admin\Resources\Services\Pages\EditService;
use App\Filament\Admin\Resources\Services\Pages\ListServices;
use App\Filament\Admin\Resources\Services\Schemas\ServiceForm;
use App\Filament\Admin\Resources\Services\Tables\ServicesTable;
use App\Models\Service;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBolt;

    protected static ?string $navigationLabel = 'Layanan';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return ServiceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServicesTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServices::route('/'),
            'create' => CreateService::route('/create'),
            'edit' => EditService::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage-services') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage-services') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage-services') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage-services') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage-services') ?? false;
    }
}
