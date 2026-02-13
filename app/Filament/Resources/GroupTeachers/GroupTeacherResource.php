<?php

namespace App\Filament\Resources\GroupTeachers;

use App\Filament\Resources\GroupTeachers\Pages\CreateGroupTeacher;
use App\Filament\Resources\GroupTeachers\Pages\EditGroupTeacher;
use App\Filament\Resources\GroupTeachers\Pages\ListGroupTeachers;
use App\Filament\Resources\GroupTeachers\Schemas\GroupTeacherForm;
use App\Filament\Resources\GroupTeachers\Tables\GroupTeachersTable;
use App\Models\GroupTeacher;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GroupTeacherResource extends Resource
{
    protected static ?string $model = GroupTeacher::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return GroupTeacherForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GroupTeachersTable::configure($table);
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
            'index' => ListGroupTeachers::route('/'),
            'create' => CreateGroupTeacher::route('/create'),
            'edit' => EditGroupTeacher::route('/{record}/edit'),
        ];
    }
}
