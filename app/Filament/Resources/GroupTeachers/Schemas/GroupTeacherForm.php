<?php

namespace App\Filament\Resources\GroupTeachers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class GroupTeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('group_id')
                    ->relationship('group', 'name')
                    ->required(),
                Select::make('teacher_id')
                    ->relationship('teacher', 'id')
                    ->required(),
                Select::make('role')
                    ->options(['responsible' => 'Responsible', 'assistant' => 'Assistant'])
                    ->default('responsible')
                    ->required(),
                DatePicker::make('assigned_date'),
            ]);
    }
}
