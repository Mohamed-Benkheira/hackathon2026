<?php

namespace App\Filament\Resources\Modules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('class_id')
                    ->relationship('class', 'id')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('name_ar')
                    ->required(),
                TextInput::make('name_fr')
                    ->required(),
                TextInput::make('coefficient')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('hours_theory')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('hours_practice')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
