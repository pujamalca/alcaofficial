<?php

namespace App\Filament\Admin\Resources\Pricing;

use App\Filament\Admin\Resources\Pricing\Pages\CreatePricingPlan;
use App\Filament\Admin\Resources\Pricing\Pages\EditPricingPlan;
use App\Filament\Admin\Resources\Pricing\Pages\ListPricingPlans;
use App\Filament\Admin\Resources\Pricing\Schemas\PricingPlanForm;
use App\Filament\Admin\Resources\Pricing\Tables\PricingPlansTable;
use App\Models\PricingPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PricingPlanResource extends Resource
{
    protected static ?string $model = PricingPlan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $navigationLabel = 'Harga';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return PricingPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PricingPlansTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPricingPlans::route('/'),
            'create' => CreatePricingPlan::route('/create'),
            'edit' => EditPricingPlan::route('/{record}/edit'),
        ];
    }
}
