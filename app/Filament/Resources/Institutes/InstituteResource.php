<?php

namespace App\Filament\Resources\Institutes;

use App\Filament\Resources\Institutes\Pages\CreateInstitute;
use App\Filament\Resources\Institutes\Pages\EditInstitute;
use App\Filament\Resources\Institutes\Pages\ListInstitutes;
use App\Filament\Resources\Institutes\Schemas\InstituteForm;
use App\Filament\Resources\Institutes\Tables\InstitutesTable;
use App\Models\Institute;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InstituteResource extends Resource
{
    protected static UnitEnum|string|null $navigationGroup = 'Gestion des Personnes';

    protected static ?string $model = Institute::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InstituteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstitutesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInstitutes::route('/'),
            'create' => CreateInstitute::route('/create'),
            'edit' => EditInstitute::route('/{record}/edit'),
        ];
    }
    public static function canViewAny(): bool
    {
        // Hide from Ministry (super_admin), show to institute admins
        return auth()->user()->role === 'super_admin';
    }
}
