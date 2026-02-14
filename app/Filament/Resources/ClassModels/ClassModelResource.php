<?php

namespace App\Filament\Resources\ClassModels;

use App\Filament\Resources\ClassModels\Pages\CreateClassModel;
use App\Filament\Resources\ClassModels\Pages\EditClassModel;
use App\Filament\Resources\ClassModels\Pages\ListClassModels;
use App\Filament\Resources\ClassModels\Schemas\ClassModelForm;
use App\Filament\Resources\ClassModels\Tables\ClassModelsTable;
use App\Models\ClassModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ClassModelResource extends Resource
{
    protected static ?string $model = ClassModel::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static UnitEnum|string|null $navigationGroup = 'Structure Académique';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Classes';

    protected static ?string $modelLabel = 'Classe';

    protected static ?string $pluralModelLabel = 'Classes';
    public static function canViewAny(): bool
    {
        // Hide from Ministry (super_admin), show to institute admins
        return auth()->user()->role !== 'super_admin';
    }

    public static function form(Schema $schema): Schema
    {
        return ClassModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassModelsTable::configure($table);
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
            'index' => ListClassModels::route('/'),
            'create' => CreateClassModel::route('/create'),
            'edit' => EditClassModel::route('/{record}/edit'),
        ];
    }
}
