<?php

namespace App\Filament\Admin\Resources\Contacts\Pages;

use App\Filament\Admin\Resources\Contacts\ContactCardResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactCard extends CreateRecord
{
    protected static string $resource = ContactCardResource::class;
}
