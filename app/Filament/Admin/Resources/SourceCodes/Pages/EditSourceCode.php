<?php

namespace App\Filament\Admin\Resources\SourceCodes\Pages;

use App\Filament\Admin\Resources\SourceCodes\SourceCodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSourceCode extends EditRecord
{
    protected static string $resource = SourceCodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Transform features array to repeater format
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_map(function ($feature) {
                return is_array($feature) ? $feature : ['feature' => $feature];
            }, $data['features']);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Clean up preview_images array structure if needed
        if (isset($data['preview_images']) && is_array($data['preview_images'])) {
            $data['preview_images'] = array_values(array_filter($data['preview_images']));
        }

        // Clean up features array structure
        if (isset($data['features']) && is_array($data['features'])) {
            $data['features'] = array_values(array_filter(array_map(function ($item) {
                return $item['feature'] ?? null;
            }, $data['features'])));
        }

        return $data;
    }
}
