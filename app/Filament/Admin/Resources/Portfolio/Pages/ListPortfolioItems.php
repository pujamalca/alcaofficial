<?php

namespace App\Filament\Admin\Resources\Portfolio\Pages;

use App\Filament\Admin\Resources\Portfolio\PortfolioItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioItems extends ListRecords
{
    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
