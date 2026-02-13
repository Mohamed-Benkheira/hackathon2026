<?php

namespace App\Filament\Resources\GroupTeachers\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class GroupTeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        // 1. Specialty (group.class.specialty.name_ar) - Read-only since it's through relationships
                        Select::make('group_id')
                            ->label('Groupe')
                            ->relationship('group', 'name')
                            ->getOptionLabelFromRecordUsing(
                                fn($record) =>
                                $record->class->specialty->name_ar . ' - ' .
                                $record->class->name_ar . ' (' . $record->name . ')'
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->columnSpanFull(),

                        // 2. Semester (group.class.semester_number) - Auto-filled from group
                        TextInput::make('group.class.semester_number')
                            ->label('Semestre')
                            ->readOnly()
                            ->placeholder('Sélectionnez un groupe'),



                        Select::make('teacher_id')
                            ->label('Enseignant')
                            ->relationship('teacher', 'id')  // Use any column as base
                            ->getOptionLabelFromRecordUsing(
                                fn($record): string =>
                                $record->last_name_ar . ' ' . $record->first_name_ar
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive(),

                        // Group as Select (instead of read-only TextInput)
                        Select::make('group_id')
                            ->label('Groupe')
                            ->relationship('group', 'name')  // ✅ Proper select
                            ->getOptionLabelFromRecordUsing(
                                fn($record) =>
                                "{$record->class->specialty->name_ar} - " .
                                "{$record->class->name_ar} (S{$record->class->semester_number}) - " .
                                $record->name
                            )
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive(),

                    ])->columnSpanFull(),

                // 6. Role (role)
                Select::make('role')
                    ->label('Rôle')
                    ->options([
                        'responsible' => 'Responsable',
                        'assistant' => 'Assistant',
                    ])
                    ->default('assistant')
                    ->required()
                    ->columnSpanFull(),

                // 7. Assigned Date (assigned_date)
                DatePicker::make('assigned_date')
                    ->label('Date d\'Affectation')
                    ->default(now())
                    ->required()
                    ->columnSpanFull(),

                // 8-9. Timestamps (created_at, updated_at) - Auto-managed
                Grid::make(2)
                    ->schema([
                        DatePicker::make('created_at')
                            ->label('Créé le')
                            ->default(now())
                            ->dehydrated(fn($state) => filled($state))
                            ->columnSpan(1),

                        DatePicker::make('updated_at')
                            ->label('Modifié le')
                            ->default(now())
                            ->dehydrated(fn($state) => filled($state))
                            ->columnSpan(1),
                    ])
                    ->visible(false), // Hidden by default
            ]);
    }
}
