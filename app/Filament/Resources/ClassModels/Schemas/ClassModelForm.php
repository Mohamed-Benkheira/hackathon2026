<?php

namespace App\Filament\Resources\ClassModels\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ClassModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('specialty_id')
                    ->relationship('specialty', 'id')
                    ->required(),
                TextInput::make('semester_number')
                    ->required()
                    ->numeric(),
                TextInput::make('certificate')
                    ->required(),
                TextInput::make('name_ar'),
                TextInput::make('name_fr'),
                TextInput::make('duration_months')
                    ->numeric(),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
