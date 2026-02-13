<?php

namespace App\Filament\Resources\WeeklySessions;

use App\Filament\Resources\WeeklySessions\Pages\CreateWeeklySession;
use App\Filament\Resources\WeeklySessions\Pages\EditWeeklySession;
use App\Filament\Resources\WeeklySessions\Pages\ListWeeklySessions;
use App\Filament\Resources\WeeklySessions\Schemas\WeeklySessionForm;
use App\Filament\Resources\WeeklySessions\Tables\WeeklySessionsTable;
use App\Models\WeeklySession;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WeeklySessionResource extends Resource
{
    protected static ?string $model = WeeklySession::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-calendar';

    protected static UnitEnum|string|null $navigationGroup = 'Emploi du Temps';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Sessions';

    protected static ?string $modelLabel = 'Session';

    protected static ?string $pluralModelLabel = 'Sessions';

    public static function form(Schema $schema): Schema
    {
        return WeeklySessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WeeklySessionsTable::configure($table);
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
            'index' => ListWeeklySessions::route('/'),
            'create' => CreateWeeklySession::route('/create'),
            'edit' => EditWeeklySession::route('/{record}/edit'),
        ];
    }
}
