<?php

namespace App\Filament\Resources\Rooms;

use App\Filament\Resources\Rooms\Pages\CreateRoom;
use App\Filament\Resources\Rooms\Pages\EditRoom;
use App\Filament\Resources\Rooms\Pages\ListRooms;
use App\Filament\Resources\Rooms\Schemas\RoomForm;
use App\Filament\Resources\Rooms\Tables\RoomsTable;
use App\Models\Room;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RoomResource extends Resource
{

    public static function canViewAny(): bool
    {
        // Hide from Ministry (super_admin), show to institute admins
        return auth()->user()->role !== 'super_admin';
    }
    protected static ?string $model = Room::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static UnitEnum|string|null $navigationGroup = 'Infrastructure';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Salles';

    protected static ?string $modelLabel = 'Salle';

    protected static ?string $pluralModelLabel = 'Salles';

    public static function form(Schema $schema): Schema
    {
        return RoomForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoomsTable::configure($table);
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
            'index' => ListRooms::route('/'),
            'create' => CreateRoom::route('/create'),
            'edit' => EditRoom::route('/{record}/edit'),
        ];
    }
}
