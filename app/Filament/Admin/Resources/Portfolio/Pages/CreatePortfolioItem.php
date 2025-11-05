<?php

namespace App\Filament\Admin\Resources\Portfolio\Pages;

use App\Filament\Admin\Resources\Portfolio\PortfolioItemResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioItem extends CreateRecord
{
    protected static string $resource = PortfolioItemResource::class;
}
