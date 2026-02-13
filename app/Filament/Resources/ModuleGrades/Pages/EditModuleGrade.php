<?php

namespace App\Filament\Resources\ModuleGrades\Pages;

use App\Filament\Resources\ModuleGrades\ModuleGradeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModuleGrade extends EditRecord
{
    protected static string $resource = ModuleGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
