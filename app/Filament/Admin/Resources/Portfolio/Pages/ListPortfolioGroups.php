<?php

namespace App\Filament\Admin\Resources\Portfolio\Pages;

use App\Filament\Admin\Resources\Portfolio\PortfolioGroupResource;
use Filament\Resources\Pages\ListRecords;

class ListPortfolioGroups extends ListRecords
{
    protected static string $resource = PortfolioGroupResource::class;
}
