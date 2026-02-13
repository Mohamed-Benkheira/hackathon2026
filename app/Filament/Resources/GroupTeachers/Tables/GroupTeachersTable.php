<?php

namespace App\Filament\Resources\GroupTeachers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GroupTeachersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group.class.specialty.name_ar')
                    ->label('Spécialité')
                    ->sortable()
                    ->searchable()
                ,

                // Class Semester (class.semester_number)
                TextColumn::make('group.class.semester_number')
                    ->label('Semestre')
                    ->badge()
                    ->colors([
                        'primary' => fn($state) => $state == 1,
                        'success' => fn($state) => $state == 2,
                        'warning' => fn($state) => $state == 3,
                    ])
                    ->sortable(),

                // Group Name (group.name)
                TextColumn::make('group.name')
                    ->label('Groupe')
                    ->searchable()
                    ->sortable(),

                // Group Capacity
                TextColumn::make('group.capacity')
                    ->label('Capacité')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),

                // Teacher Full Name
                TextColumn::make('teacher.full_name_ar')
                    ->label('Enseignant')
                    ->getStateUsing(
                        fn($record) =>
                        $record->teacher->last_name_ar . ' ' . $record->teacher->first_name_ar
                    )
                    ->searchable(['teacher.first_name_ar', 'teacher.last_name_ar'])
                    ->sortable('teacher_id'),

                // Role Badge
                BadgeColumn::make('role')
                    ->label('Rôle')
                    ->colors([
                        'primary' => 'responsible',
                        'success' => 'assistant',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'responsible' => 'Responsable',
                        'assistant' => 'Assistant',
                        default => $state,
                    }),

                // Assigned Date
                TextColumn::make('assigned_date')
                    ->label('Affecté le')
                    ->date('d/m/Y')
                    ->sortable()
                    ->sortable(),

                // Timestamps
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
