<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeOrderResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSourceCodeOrder extends CreateRecord
{
    protected static string $resource = SourceCodeOrderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
