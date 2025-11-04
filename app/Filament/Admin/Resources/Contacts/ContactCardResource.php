<?php

namespace App\Filament\Admin\Resources\Contacts;

use App\Filament\Admin\Resources\Contacts\Pages\CreateContactCard;
use App\Filament\Admin\Resources\Contacts\Pages\EditContactCard;
use App\Filament\Admin\Resources\Contacts\Pages\ListContactCards;
use App\Models\ContactCard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;
use BackedEnum;

class ContactCardResource extends Resource
{
    protected static ?string $model = ContactCard::class;

    protected static UnitEnum|string|null $navigationGroup = 'Website';

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Kontak';

    protected static ?int $navigationSort = 50;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Kontak')
                ->schema([
                    TextInput::make('title')->label('Judul')->required()->maxLength(150),
                    TextInput::make('value')->label('Konten')->maxLength(150),
                    Textarea::make('description')->label('Deskripsi')->rows(3),
                    TextInput::make('icon')->label('Heroicon')->placeholder('heroicon-o-phone-arrow-up-right'),
                    TextInput::make('link')->label('URL / Aksi')->maxLength(255),
                    TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                    Toggle::make('is_active')->label('Tampilkan')->default(true),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('value')->label('Konten')->wrap(),
                Tables\Columns\IconColumn::make('is_active')->label('Aktif')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->label('Urutan')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListContactCards::route('/'),
            'create' => CreateContactCard::route('/create'),
            'edit' => EditContactCard::route('/{record}/edit'),
        ];
    }
}
