<?php

namespace App\Filament\Admin\Resources\Portfolio\Pages;

use App\Filament\Admin\Resources\Portfolio\PortfolioItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioItem extends EditRecord
{
    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
