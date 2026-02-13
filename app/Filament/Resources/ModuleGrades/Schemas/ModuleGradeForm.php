<?php

namespace App\Filament\Resources\ModuleGrades\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleGradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Select::make('module_id')
                    ->relationship('module', 'id')
                    ->required(),
                TextInput::make('controle1')
                    ->numeric(),
                TextInput::make('controle2')
                    ->numeric(),
                TextInput::make('examen_final')
                    ->numeric(),
                TextInput::make('moyenne_module')
                    ->numeric(),
                TextInput::make('coefficient')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('moyenne_ponderee')
                    ->numeric(),
                Select::make('status')
                    ->options(['pending' => 'Pending', 'validated' => 'Validated', 'pass' => 'Pass', 'fail' => 'Fail'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
