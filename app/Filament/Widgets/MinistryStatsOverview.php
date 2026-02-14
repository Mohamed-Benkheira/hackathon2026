<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\{Institute, Student, Teacher, ModuleGrade};

class MinistryStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    public static function canView(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    protected function getStats(): array
    {
        $totalGrades = ModuleGrade::count();
        $passedGrades = ModuleGrade::whereIn('status', ['pass', 'validated'])->count();
        $passRate = $totalGrades > 0 ? round(($passedGrades / $totalGrades) * 100, 1) : 0;

        return [
            Stat::make('Total Institutes', Institute::count())
                ->description('Nationwide coverage')
                ->descriptionIcon('heroicon-o-building-office-2')
                ->color('primary'),

            Stat::make('Total Students', number_format(Student::count()))
                ->description('Active enrollment')
                ->descriptionIcon('heroicon-o-academic-cap')
                ->color('success'),

            Stat::make('Total Teachers', Teacher::count())
                ->description('Educational staff')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('warning'),

            Stat::make('National Pass Rate', $passRate . '%')
                ->description('All institutes average')
                ->descriptionIcon('heroicon-o-trophy')
                ->color('info'),
        ];
    }
}
