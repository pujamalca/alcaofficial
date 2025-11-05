<?php

namespace App\Filament\Admin\Resources\Contacts\Pages;

use App\Filament\Admin\Resources\Contacts\ContactCardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactCards extends ListRecords
{
    protected static string $resource = ContactCardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Kontak Baru'),
        ];
    }
}
