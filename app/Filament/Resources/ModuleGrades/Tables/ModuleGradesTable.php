<?php

namespace App\Filament\Resources\ModuleGrades\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ModuleGradesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.id')
                    ->searchable(),
                TextColumn::make('module.id')
                    ->searchable(),
                TextColumn::make('controle1')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('controle2')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('examen_final')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('moyenne_module')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('coefficient')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('moyenne_ponderee')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
