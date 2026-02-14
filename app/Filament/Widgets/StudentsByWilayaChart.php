<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StudentsByWilayaChart extends ChartWidget
{
    protected ?string $heading = ' Student Distribution by Wilaya';
    protected static ?int $sort = 4;
    protected int|string|array $columnSpan = 'half';

    public static function canView(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    protected function getData(): array
    {
        $wilayaData = DB::table('institutes')
            ->join('students', 'institutes.id', '=', 'students.institute_id')
            ->select('institutes.wilaya', DB::raw('COUNT(students.id) as total'))
            ->whereNotNull('institutes.wilaya')
            ->groupBy('institutes.wilaya')
            ->orderByDesc('total')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $wilayaData->pluck('total')->toArray(),
                    'backgroundColor' => [
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(168, 85, 247, 0.8)',
                        'rgba(236, 72, 153, 0.8)',
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(245, 158, 11, 0.8)',
                    ],
                    'borderColor' => [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(168, 85, 247)',
                        'rgb(236, 72, 153)',
                        'rgb(99, 102, 241)',
                        'rgb(245, 158, 11)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $wilayaData->pluck('wilaya')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Students',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Wilaya',
                    ],
                ],
            ],
        ];
    }
}
