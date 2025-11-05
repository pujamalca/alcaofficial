<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeOrderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSourceCodeOrder extends EditRecord
{
    protected static string $resource = SourceCodeOrderResource::class;

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
