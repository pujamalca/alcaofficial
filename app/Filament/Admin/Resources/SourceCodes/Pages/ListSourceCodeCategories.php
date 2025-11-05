<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSourceCodeCategories extends ListRecords
{
    protected static string $resource = SourceCodeCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
