<?php

namespace App\Filament\Resources\GroupTeachers\Pages;

use App\Filament\Resources\GroupTeachers\GroupTeacherResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroupTeacher extends EditRecord
{
    protected static string $resource = GroupTeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
