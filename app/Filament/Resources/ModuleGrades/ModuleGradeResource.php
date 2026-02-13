<?php

namespace App\Filament\Resources\ModuleGrades;

use App\Filament\Resources\ModuleGrades\Pages\CreateModuleGrade;
use App\Filament\Resources\ModuleGrades\Pages\EditModuleGrade;
use App\Filament\Resources\ModuleGrades\Pages\ListModuleGrades;
use App\Filament\Resources\ModuleGrades\Schemas\ModuleGradeForm;
use App\Filament\Resources\ModuleGrades\Tables\ModuleGradesTable;
use App\Models\ModuleGrade;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ModuleGradeResource extends Resource
{
    protected static ?string $model = ModuleGrade::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ModuleGradeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModuleGradesTable::configure($table);
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
            'index' => ListModuleGrades::route('/'),
            'create' => CreateModuleGrade::route('/create'),
            'edit' => EditModuleGrade::route('/{record}/edit'),
        ];
    }
}
