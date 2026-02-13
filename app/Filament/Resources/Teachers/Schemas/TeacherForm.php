<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name_ar')
                    ->required(),
                TextInput::make('last_name_ar')
                    ->required(),
                TextInput::make('first_name_fr'),
                TextInput::make('last_name_fr'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
