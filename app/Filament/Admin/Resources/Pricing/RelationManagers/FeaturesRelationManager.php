<?php

namespace App\\Filament\\Admin\\Resources\\Pricing\\RelationManagers;

use Filament\\Forms\\Components\Section;
use Filament\\Forms\\Components\TextInput;
use Filament\\Resources\\RelationManagers\HasManyRelationManager;
use Filament\\Schemas\Schema;
use Filament\\Tables;
use Filament\\Tables\Table;

class FeaturesRelationManager extends HasManyRelationManager
{
    protected static string  = 'features';

    protected static ?string  = 'Fitur Paket';

    public static function form(Schema ): Schema
    {
        return ->components([
            Section::make()
                ->schema([
                    TextInput::make('feature')
                        ->label('Fitur')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table ): Table
    {
        return 
            ->columns([
                Tables\Columns\TextColumn::make('feature')
                    ->label('Fitur')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}

