<?php

namespace App\Filament\Resources\Exams\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('exam_session_id')
                    ->relationship('examSession', 'name')
                    ->required(),
                Select::make('module_id')
                    ->relationship('module', 'id')
                    ->required(),
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->required(),
                Select::make('time_slot_id')
                    ->relationship('timeSlot', 'id')
                    ->required(),
                TextInput::make('student_count')
                    ->required()
                    ->numeric(),
                TextInput::make('status')
                    ->required()
                    ->default('scheduled'),
            ]);
    }
}
