<?php

namespace App\Filament\Resources\WeeklyExceptions\Pages;

use App\Filament\Resources\WeeklyExceptions\WeeklyExceptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWeeklyExceptions extends ListRecords
{
    protected static string $resource = WeeklyExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
