<?php

namespace App\Filament\Resources\Students\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StudentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('matricule')
                    ->searchable(),
                TextColumn::make('first_name_ar')
                    ->searchable(),
                TextColumn::make('last_name_ar')
                    ->searchable(),
                TextColumn::make('first_name_fr')
                    ->searchable(),
                TextColumn::make('last_name_fr')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('gender')
                    ->searchable(),
                TextColumn::make('formation_type')
                    ->badge(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('internship_company')
                    ->searchable(),
                TextColumn::make('internship_start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('internship_end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('group.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('entry_date')
                    ->date()
                    ->sortable(),
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
