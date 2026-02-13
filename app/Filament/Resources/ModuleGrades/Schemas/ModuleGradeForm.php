<?php

namespace App\Filament\Resources\ModuleGrades\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ModuleGradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ✅ Student Full Name (first_name_ar + last_name_ar)
                Select::make('student_id')
                    ->label('Étudiant')
                    ->relationship('student', 'id')
                    ->getOptionLabelFromRecordUsing(
                        fn($record): string =>
                        "{$record->last_name_ar} {$record->first_name_ar}"
                    )
                    ->searchable(['first_name_ar', 'last_name_ar'])
                    ->preload()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(fn(callable $set) => $set('module_id', null)),

                Select::make('module')
                    ->label('Module')
                    ->relationship(
                        name: 'module',
                        titleAttribute: 'name_ar',
                        modifyQueryUsing: function ($query, \Filament\Schemas\Components\Utilities\Get $get) {
                            $studentId = $get('student_id');

                            if ($studentId) {
                                return $query->whereDoesntHave('moduleGrades', function ($q) use ($studentId) {
                                    $q->where('student_id', $studentId);
                                });
                            }

                            return $query;
                        }
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record): string =>
                        "({$record->code}) {$record->name_ar}"
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->disabled(fn($operation) => $operation === 'edit')
                    // ✅ This shows the CURRENT module name when disabled
                    ->placeholder(
                        fn($record) => $record && $record->module
                        ? "({$record->module->code}) {$record->module->name_ar}"
                        : 'Sélectionnez un étudiant d\'abord'
                    ),


                // Grades
                Grid::make(3)
                    ->schema([
                        TextInput::make('controle1')
                            ->label('Contrôle 1 (/20)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(20)
                            ->step(0.5)
                            ->required(),

                        TextInput::make('controle2')
                            ->label('Contrôle 2 (/20)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(20)
                            ->step(0.5)
                            ->required(),

                        TextInput::make('examen_final')
                            ->label('Examen Final (/20)')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(20)
                            ->step(0.5)
                            ->required(),
                    ]),

                // Computed Fields
                TextInput::make('moyenne_module')
                    ->label('Moyenne Module (/20)')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(20)
                    ->step(0.01)
                    ->dehydrated(false)
                    ->readOnly()
                    ->placeholder('Auto-calculée'),

                TextInput::make('moyenne_ponderee')
                    ->label('Moyenne Pondérée')
                    ->numeric()
                    ->step(0.01)
                    ->dehydrated(false)
                    ->readOnly()
                    ->placeholder('Auto-calculée'),

                // Coefficient
                Select::make('coefficient')
                    ->label('Coefficient')
                    ->options([1 => '1', 2 => '2', 3 => '3', 4 => '4'])
                    ->default(1)
                    ->required()
                    ->reactive(),

                // Status
                Select::make('status')
                    ->label('Statut')
                    ->options([
                        'pending' => 'En attente',
                        'validated' => 'Validé',
                        'pass' => 'Admis',
                        'fail' => 'Ajourné',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
