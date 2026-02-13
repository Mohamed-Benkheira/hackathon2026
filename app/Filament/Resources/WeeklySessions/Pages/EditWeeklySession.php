<?php

namespace App\Filament\Resources\WeeklySessions\Pages;

use App\Filament\Resources\WeeklySessions\WeeklySessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWeeklySession extends EditRecord
{
    protected static string $resource = WeeklySessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
