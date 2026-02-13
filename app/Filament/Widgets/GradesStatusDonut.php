<?php
namespace App\Filament\Widgets;

use App\Models\ModuleGrade;
use Filament\Widgets\ChartWidget;

class GradesStatusDonut extends ChartWidget
{
    protected ?string $heading = 'Module grades by status';

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $rows = ModuleGrade::query()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        return [
            'labels' => $rows->pluck('status')->all(),
            'datasets' => [
                [
                    'label' => 'Grades',
                    'data' => $rows->pluck('total')->all(),
                ],
            ],
        ];
    }
}
