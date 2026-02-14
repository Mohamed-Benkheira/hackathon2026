<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class InfrastructureUtilization extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-building-office-2';
    protected string $view = 'filament.pages.infrastructure-utilization';
    protected static ?string $navigationLabel = 'Infrastructure';
    protected static ?string $title = '🏢 Infrastructure Utilization Analysis';
    protected static ?int $navigationSort = 5;
    protected static UnitEnum|string|null $navigationGroup = 'AI Recommendations';

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    public function getRecommendations(): array
    {
        return [
            [
                'status' => 'overcapacity',
                'institute' => 'INSFP Oran',
                'capacity' => 600,
                'current_students' => 615,
                'utilization' => 102.5,
                'issue' => 'Operating above capacity, affecting quality',
                'recommendation' => 'Immediate expansion: Add 3 new classrooms or redistribute 100 students to nearby institutes',
                'rooms_available' => 0,
                'priority' => 'Critical'
            ],
            [
                'status' => 'near_capacity',
                'institute' => 'INSFP Sétif',
                'capacity' => 550,
                'current_students' => 508,
                'utilization' => 92.4,
                'issue' => 'Approaching full capacity, limited flexibility',
                'recommendation' => 'Plan expansion within 12 months or implement dual-shift system',
                'rooms_available' => 2,
                'priority' => 'High'
            ],
            [
                'status' => 'underutilized',
                'institute' => 'INSFP Tlemcen',
                'capacity' => 500,
                'current_students' => 325,
                'utilization' => 65.0,
                'issue' => 'Significant unused capacity, inefficient resource use',
                'recommendation' => 'Increase enrollment by 150 students or add evening classes for working professionals',
                'rooms_available' => 7,
                'priority' => 'Medium'
            ],
            [
                'status' => 'optimal',
                'institute' => 'INSFP Béjaïa',
                'capacity' => 480,
                'current_students' => 398,
                'utilization' => 82.9,
                'issue' => 'Well-balanced utilization',
                'recommendation' => 'Maintain current enrollment levels, minor adjustments as needed',
                'rooms_available' => 4,
                'priority' => 'Low'
            ],
        ];
    }
}
