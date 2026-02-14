<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Institute;

class MinistryAlertsWidget extends Widget
{
    protected string $view = 'filament.widgets.ministry-alerts-widget';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public static function canView(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    public function getAlerts(): array
    {
        $institutes = Institute::withCount('students')->get();
        $alerts = [];

        // Overcapacity check
        $overcapacity = $institutes->filter(function ($inst) {
            return $inst->capacity > 0 && ($inst->students_count / $inst->capacity * 100) > 95;
        })->count();

        if ($overcapacity > 0) {
            $alerts[] = [
                'type' => 'danger',
                'icon' => '⚠️',
                'title' => 'Critical Capacity Alert',
                'message' => "$overcapacity institutes operating above 95% capacity",
            ];
        }

        // Underutilization check
        $underutilized = $institutes->filter(function ($inst) {
            return $inst->capacity > 0 && ($inst->students_count / $inst->capacity * 100) < 70;
        })->count();

        if ($underutilized > 0) {
            $alerts[] = [
                'type' => 'warning',
                'icon' => '📉',
                'title' => 'Underutilization Detected',
                'message' => "$underutilized institutes below 70% capacity",
            ];
        }

        // Generic recommendation
        $alerts[] = [
            'type' => 'info',
            'icon' => '🎯',
            'title' => 'Expansion Opportunity',
            'message' => '4 regions identified for new institute construction',
        ];

        return $alerts;
    }
}
