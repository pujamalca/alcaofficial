<?php

namespace App\Filament\Admin\Resources\Contacts;

use App\Filament\Admin\Resources\Contacts\Pages\CreateContactCard;
use App\Filament\Admin\Resources\Contacts\Pages\EditContactCard;
use App\Filament\Admin\Resources\Contacts\Pages\ListContactCards;
use App\Filament\Admin\Resources\Contacts\Schemas\ContactCardForm;
use App\Filament\Admin\Resources\Contacts\Tables\ContactCardsTable;
use App\Models\ContactCard;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactCardResource extends Resource
{
    protected static ?string $model = ContactCard::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;

    protected static ?string $navigationLabel = 'Kontak';

    protected static ?int $navigationSort = 50;

    public static function form(Schema $schema): Schema
    {
        return ContactCardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactCardsTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactCards::route('/'),
            'create' => CreateContactCard::route('/create'),
            'edit' => EditContactCard::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage-contacts') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage-contacts') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage-contacts') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage-contacts') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage-contacts') ?? false;
    }
}
