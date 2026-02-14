<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class TopSpecialtiesChart extends ChartWidget
{
    protected ?string $heading = 'Most popular Specialties by Enrollment';
    protected static ?int $sort = 3;
    protected int|string|array $columnSpan = 'half';

    public static function canView(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    protected function getData(): array
    {
        $specialties = DB::table('specialties')
            ->join('classes', 'specialties.id', '=', 'classes.specialty_id')
            ->join('groups', 'classes.id', '=', 'groups.class_id')
            ->join('students', 'groups.id', '=', 'students.group_id')
            ->select('specialties.name_fr', DB::raw('COUNT(students.id) as total'))
            ->groupBy('specialties.id', 'specialties.name_fr')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $specialties->pluck('total')->toArray(),
                    'backgroundColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)',
                        'rgb(99, 102, 241)',
                        'rgb(239, 68, 68)',
                        'rgb(245, 158, 11)',
                        'rgb(20, 184, 166)',
                        'rgb(249, 115, 22)',
                        'rgb(6, 182, 212)',
                    ],
                ],
            ],
            'labels' => $specialties->pluck('name_fr')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
