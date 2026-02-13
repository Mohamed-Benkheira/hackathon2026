<?php

namespace App\Filament\Resources\WeeklySessions\Pages;

use App\Filament\Resources\WeeklySessions\WeeklySessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWeeklySessions extends ListRecords
{
    protected static string $resource = WeeklySessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
