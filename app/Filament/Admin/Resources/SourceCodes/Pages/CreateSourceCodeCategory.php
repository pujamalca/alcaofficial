<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSourceCodeCategory extends CreateRecord
{
    protected static string $resource = SourceCodeCategoryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
