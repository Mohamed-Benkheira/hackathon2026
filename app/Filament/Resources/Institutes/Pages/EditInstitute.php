<?php

namespace App\Filament\Resources\Institutes\Pages;

use App\Filament\Resources\Institutes\InstituteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInstitute extends EditRecord
{
    protected static string $resource = InstituteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
