<?php
namespace App\Filament\Widgets;

use App\Models\ClassModel; // rename to your actual Class model (can't be "Class")
use App\Models\Exam;
use App\Models\Group;
use App\Models\ModuleGrade;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Students', Student::query()->count()),
            Stat::make('Groups', Group::query()->count()),
            Stat::make('Classes (active)', ClassModel::query()->where('is_active', true)->count()),
            Stat::make('Exams', Exam::query()->count()),
            Stat::make('Module grades', ModuleGrade::query()->count()),
        ];
    }
    public static function canView(): bool
    {
        return auth()->user()->role === 'admin';
    }
}
