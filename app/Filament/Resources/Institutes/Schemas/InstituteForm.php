<?php

namespace App\Filament\Resources\Institutes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InstituteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code'),
                TextInput::make('wilaya'),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(500),
            ]);
    }
}
