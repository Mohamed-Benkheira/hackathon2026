<?php

namespace App\Filament\Resources\GroupTeachers\Pages;

use App\Filament\Resources\GroupTeachers\GroupTeacherResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupTeachers extends ListRecords
{
    protected static string $resource = GroupTeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
