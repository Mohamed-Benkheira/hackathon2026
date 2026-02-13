<?php

namespace App\Filament\Resources\ExamRooms\Pages;

use App\Filament\Resources\ExamRooms\ExamRoomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExamRooms extends ListRecords
{
    protected static string $resource = ExamRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
