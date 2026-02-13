<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('matricule')
                    ->required(),
                TextInput::make('first_name_ar')
                    ->required(),
                TextInput::make('last_name_ar')
                    ->required(),
                TextInput::make('first_name_fr'),
                TextInput::make('last_name_fr'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                DatePicker::make('birth_date'),
                TextInput::make('gender'),
                Select::make('formation_type')
                    ->options(['apprentice' => 'Apprentice', 'presential' => 'Presential', 'remote' => 'Remote'])
                    ->required(),
                TextInput::make('company_name'),
                Textarea::make('company_address')
                    ->columnSpanFull(),
                TextInput::make('internship_company'),
                DatePicker::make('internship_start_date'),
                DatePicker::make('internship_end_date'),
                Select::make('group_id')
                    ->relationship('group', 'name'),
                Select::make('status')
                    ->options([
            'active' => 'Active',
            'completed' => 'Completed',
            'dropped' => 'Dropped',
            'suspended' => 'Suspended',
        ])
                    ->default('active')
                    ->required(),
                DatePicker::make('entry_date'),
            ]);
    }
}
