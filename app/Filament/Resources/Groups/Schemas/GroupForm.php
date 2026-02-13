<?php

namespace App\Filament\Resources\Groups\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Select::make('class_id')
                    ->label('Classe')
                    ->relationship(
                        name: 'class',
                        titleAttribute: 'name_ar',
                        modifyQueryUsing: fn($query, $get) => $query->with('specialty')
                    )
                    ->getOptionLabelFromRecordUsing(
                        fn($record) =>
                        "{$record->specialty->name_ar} - {$record->name_ar} (S{$record->semester_number})"
                    )
                    ->searchable()
                    ->preload()
                    ->required()
                    ->reactive(),

                // Group Name (name)
                TextInput::make('name')
                    ->label('Nom du Groupe (A/B/C)')
                    ->required()
                    ->maxLength(10)
                    ->placeholder('A, B, C...'),

                // Capacity (capacity)
                TextInput::make('capacity')
                    ->label('Capacité')
                    ->numeric()
                    ->default(30)
                    ->minValue(20)
                    ->maxValue(50)
                    ->required()
                    ->step(5),

                // Current Students (current_students) - Read-only or with validation
                TextInput::make('current_students')
                    ->label('Étudiants Actuels')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(fn($get) => $get('capacity') ?? 50)
                    ->dehydrated(false) // Don't save this, let it auto-update
                    ->helperText('Se met à jour automatiquement avec les étudiants'),

            ]);
    }
}
