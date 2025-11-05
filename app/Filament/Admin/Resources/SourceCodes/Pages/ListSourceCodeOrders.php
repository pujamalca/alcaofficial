<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSourceCodeOrders extends ListRecords
{
    protected static string $resource = SourceCodeOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
