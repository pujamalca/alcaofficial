<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSourceCodeCategory extends EditRecord
{
    protected static string $resource = SourceCodeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
