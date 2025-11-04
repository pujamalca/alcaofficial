<?php

namespace App\Filament\Admin\Resources\Contacts\Pages;

use App\Filament\Admin\Resources\Contacts\ContactCardResource;
use Filament\Resources\Pages\EditRecord;

class EditContactCard extends EditRecord
{
    protected static string $resource = ContactCardResource::class;
}
