<?php

namespace App\Filament\Admin\Resources\Pricing\Pages;

use App\Filament\Admin\Resources\Pricing\PricingPlanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPricingPlans extends ListRecords
{
    protected static string $resource = PricingPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Paket Harga Baru'),
        ];
    }
}
