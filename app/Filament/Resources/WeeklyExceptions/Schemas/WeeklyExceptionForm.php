<?php

namespace App\Filament\Resources\WeeklyExceptions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WeeklyExceptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('weekly_session_id')
                    ->relationship('weeklySession', 'id')
                    ->required(),
                DatePicker::make('exception_date')
                    ->required(),
                TextInput::make('reason'),
                Toggle::make('is_cancelled')
                    ->required(),
            ]);
    }
}
