<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\{Institute, Student, Teacher, ModuleGrade, Specialty};
use Illuminate\Support\Facades\DB;
use BackedEnum;
class MinistryDashboard extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar';
    protected string $view = 'filament.pages.ministry-dashboard';
    protected static ?string $navigationLabel = 'Ministry Dashboard';
    protected static ?string $title = 'Ministry Dashboard';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        // Only super_admin can access
        return auth()->user()->role === 'super_admin';
    }

    public function getViewData(): array
    {
        return [
            'stats' => $this->getStats(),
            'institutes' => $this->getInstituteData(),
            'specialties' => $this->getSpecialtyDistribution(),
            'wilayaStats' => $this->getWilayaStats(),
        ];
    }

    protected function getStats(): array
    {
        $totalGrades = ModuleGrade::count();
        $passedGrades = ModuleGrade::whereIn('status', ['pass', 'validated'])->count();

        return [
            'total_institutes' => Institute::count(),
            'total_students' => Student::count(),
            'total_teachers' => Teacher::count(),
            'pass_rate' => $totalGrades > 0 ? round(($passedGrades / $totalGrades) * 100, 1) : 0,
        ];
    }

    protected function getInstituteData(): array
    {
        return Institute::withCount('students', 'teachers')
            ->get()
            ->map(function ($inst) {
                return [
                    'name' => $inst->name,
                    'code' => $inst->code,
                    'wilaya' => $inst->wilaya ?? 'N/A',
                    'students' => $inst->students_count,
                    'teachers' => $inst->teachers_count,
                    'capacity' => $inst->capacity,
                    'utilization' => $inst->capacity > 0
                        ? round(($inst->students_count / $inst->capacity) * 100, 1)
                        : 0,
                ];
            })
            ->sortByDesc('students')
            ->values()
            ->toArray();
    }

    protected function getSpecialtyDistribution(): array
    {
        return DB::table('specialties')
            ->join('classes', 'specialties.id', '=', 'classes.specialty_id')
            ->join('groups', 'classes.id', '=', 'groups.class_id')
            ->select('specialties.name_fr', DB::raw('SUM(groups.current_students) as total_students'))
            ->groupBy('specialties.id', 'specialties.name_fr')
            ->orderByDesc('total_students')
            ->limit(10)
            ->get()
            ->map(fn($s) => [
                'name' => $s->name_fr,
                'count' => $s->total_students,
            ])
            ->toArray();
    }

    protected function getWilayaStats(): array
    {
        return Institute::select('wilaya', DB::raw('COUNT(*) as institute_count'), DB::raw('SUM(capacity) as total_capacity'))
            ->whereNotNull('wilaya')
            ->groupBy('wilaya')
            ->get()
            ->map(fn($w) => [
                'wilaya' => $w->wilaya,
                'institutes' => $w->institute_count,
                'capacity' => $w->total_capacity,
            ])
            ->toArray();
    }
}
