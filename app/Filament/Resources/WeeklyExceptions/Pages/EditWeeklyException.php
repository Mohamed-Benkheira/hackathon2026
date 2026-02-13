<?php

namespace App\Filament\Resources\WeeklyExceptions\Pages;

use App\Filament\Resources\WeeklyExceptions\WeeklyExceptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditWeeklyException extends EditRecord
{
    protected static string $resource = WeeklyExceptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
