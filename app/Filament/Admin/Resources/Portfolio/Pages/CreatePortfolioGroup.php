<?php

namespace App\Filament\Admin\Resources\Portfolio\Pages;

use App\Filament\Admin\Resources\Portfolio\PortfolioGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioGroup extends CreateRecord
{
    protected static string $resource = PortfolioGroupResource::class;
}
