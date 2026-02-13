<?php

namespace App\Filament\Resources\WeeklyExceptions;

use App\Filament\Resources\WeeklyExceptions\Pages\CreateWeeklyException;
use App\Filament\Resources\WeeklyExceptions\Pages\EditWeeklyException;
use App\Filament\Resources\WeeklyExceptions\Pages\ListWeeklyExceptions;
use App\Filament\Resources\WeeklyExceptions\Schemas\WeeklyExceptionForm;
use App\Filament\Resources\WeeklyExceptions\Tables\WeeklyExceptionsTable;
use App\Models\WeeklyException;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WeeklyExceptionResource extends Resource
{
    protected static ?string $model = WeeklyException::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return WeeklyExceptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WeeklyExceptionsTable::configure($table);
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
            'index' => ListWeeklyExceptions::route('/'),
            'create' => CreateWeeklyException::route('/create'),
            'edit' => EditWeeklyException::route('/{record}/edit'),
        ];
    }
}
