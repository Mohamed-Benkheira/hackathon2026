<?php

namespace App\Filament\Resources\ModuleGrades\Pages;

use App\Filament\Resources\ModuleGrades\ModuleGradeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModuleGrades extends ListRecords
{
    protected static string $resource = ModuleGradeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
