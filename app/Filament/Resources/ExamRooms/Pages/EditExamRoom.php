<?php

namespace App\Filament\Resources\ExamRooms\Pages;

use App\Filament\Resources\ExamRooms\ExamRoomResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditExamRoom extends EditRecord
{
    protected static string $resource = ExamRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
