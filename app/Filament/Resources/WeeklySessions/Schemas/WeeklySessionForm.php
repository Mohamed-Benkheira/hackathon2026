<?php

namespace App\Filament\Resources\WeeklySessions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class WeeklySessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->required(),
                Select::make('module_id')
                    ->relationship('module', 'id'),
                Select::make('teacher_id')
                    ->relationship('teacher', 'id'),
                TextInput::make('day_of_week')
                    ->required()
                    ->numeric(),
                TimePicker::make('slot_start')
                    ->required(),
                TimePicker::make('slot_end')
                    ->required(),
                TextInput::make('slot_number')
                    ->required()
                    ->numeric(),
                Select::make('session_type')
                    ->options(['theory' => 'Theory', 'practice' => 'Practice', 'lab' => 'Lab'])
                    ->default('theory')
                    ->required(),
                Select::make('room_id')
                    ->relationship('room', 'name'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('week_repeats')
                    ->required()
                    ->default('every_week'),
            ]);
    }
}
