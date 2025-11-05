<?php

namespace App\Filament\Admin\Resources\Testimonials;

use App\Filament\Admin\Resources\Testimonials\Pages\CreateTestimonial;
use App\Filament\Admin\Resources\Testimonials\Pages\EditTestimonial;
use App\Filament\Admin\Resources\Testimonials\Pages\ListTestimonials;
use App\Filament\Admin\Resources\Testimonials\Schemas\TestimonialForm;
use App\Filament\Admin\Resources\Testimonials\Tables\TestimonialsTable;
use App\Models\Testimonial;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftRight;

    protected static ?string $navigationLabel = 'Testimoni';

    protected static ?int $navigationSort = 40;

    public static function form(Schema $schema): Schema
    {
        return TestimonialForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestimonialsTable::configure($table);
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Website';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonials::route('/'),
            'create' => CreateTestimonial::route('/create'),
            'edit' => EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage-testimonials') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage-testimonials') ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->can('manage-testimonials') ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->can('manage-testimonials') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage-testimonials') ?? false;
    }
}
