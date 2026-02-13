<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class StudentsByStatusChart extends ChartWidget
{
    protected ?string $heading = 'Students by status';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $rows = \App\Models\Student::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        return [
            'labels' => $rows->pluck('status')->all(),
            'datasets' => [
                [
                    'label' => 'Students',
                    'data' => $rows->pluck('total')->all(),
                ],
            ],
        ];
    }
}
