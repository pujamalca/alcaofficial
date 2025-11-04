<?php

namespace App\Filament\Admin\Resources\Pricing\Pages;

use App\Filament\Admin\Resources\Pricing\PricingPlanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePricingPlan extends CreateRecord
{
    protected static string $resource = PricingPlanResource::class;
}
