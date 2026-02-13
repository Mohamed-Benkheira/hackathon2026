<?php

namespace App\Filament\Resources\Specialties\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SpecialtyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name_ar')
                    ->required(),
                TextInput::make('name_fr')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                Select::make('role')
                    ->options(['apprentice' => 'Apprentice', 'presential' => 'Presential', 'remote' => 'Remote'])
                    ->required(),
                TextInput::make('certificate_types'),
                TextInput::make('duration_months')
                    ->numeric(),
            ]);
    }
}
