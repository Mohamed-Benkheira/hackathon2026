<?php

namespace App\Filament\Resources\ExamRooms;

use App\Filament\Resources\ExamRooms\Pages\CreateExamRoom;
use App\Filament\Resources\ExamRooms\Pages\EditExamRoom;
use App\Filament\Resources\ExamRooms\Pages\ListExamRooms;
use App\Filament\Resources\ExamRooms\Schemas\ExamRoomForm;
use App\Filament\Resources\ExamRooms\Tables\ExamRoomsTable;
use App\Models\ExamRoom;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ExamRoomResource extends Resource
{
    protected static ?string $model = ExamRoom::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-map-pin';

    protected static UnitEnum|string|null $navigationGroup = 'Examens';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationLabel = 'Salles d\'Examen';

    protected static ?string $modelLabel = 'Salle d\'Examen';

    protected static ?string $pluralModelLabel = 'Salles d\'Examen';
    public static function form(Schema $schema): Schema
    {
        return ExamRoomForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamRoomsTable::configure($table);
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
            'index' => ListExamRooms::route('/'),
            'create' => CreateExamRoom::route('/create'),
            'edit' => EditExamRoom::route('/{record}/edit'),
        ];
    }
}
