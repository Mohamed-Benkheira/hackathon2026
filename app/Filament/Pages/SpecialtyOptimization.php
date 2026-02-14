<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
class SpecialtyOptimization extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-academic-cap';
    protected string $view = 'filament.pages.specialty-optimization';
    protected static ?string $navigationLabel = 'Specialty Optimization';
    protected static ?string $title = '🎯 Specialty Optimization Strategy';
    protected static ?int $navigationSort = 3;
    protected static UnitEnum|string|null $navigationGroup = 'AI Recommendations';

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    public function getRecommendations(): array
    {
        return [
            [
                'action' => 'expand',
                'specialty' => 'Agriculture & Irrigation',
                'current_students' => 450,
                'target_students' => 900,
                'reason' => 'Sétif & Constantine wilayas have 35% agriculture economy but only 15% students in this field',
                'success_rate' => 87,
                'job_demand' => 'Very High',
                'institutes_affected' => ['INSFP Sétif', 'INSFP Constantine'],
                'timeline' => '2 semesters',
                'additional_resources' => 'Need 5 new teachers, 2 practice farms'
            ],
            [
                'action' => 'expand',
                'specialty' => 'Industrial Maintenance',
                'current_students' => 680,
                'target_students' => 1100,
                'reason' => 'High job placement rate (92%) and growing industrial sector in Oran & Béjaïa',
                'success_rate' => 89,
                'job_demand' => 'High',
                'institutes_affected' => ['INSFP Oran', 'INSFP Béjaïa'],
                'timeline' => '3 semesters',
                'additional_resources' => 'Need 7 new teachers, equipment upgrade'
            ],
            [
                'action' => 'reduce',
                'specialty' => 'Traditional Office Administration',
                'current_students' => 820,
                'target_students' => 400,
                'reason' => 'Low job placement (45%), declining demand due to digitalization',
                'success_rate' => 71,
                'job_demand' => 'Low',
                'institutes_affected' => ['INSFP Alger', 'INSFP Tlemcen'],
                'timeline' => '2 semesters',
                'additional_resources' => 'Repurpose teachers to Digital Marketing specialty'
            ],
            [
                'action' => 'transform',
                'specialty' => 'Accounting → FinTech & Digital Accounting',
                'current_students' => 560,
                'target_students' => 650,
                'reason' => 'Traditional accounting declining, but FinTech skills in high demand',
                'success_rate' => 78,
                'job_demand' => 'Medium to High',
                'institutes_affected' => ['INSFP Alger', 'INSFP Oran'],
                'timeline' => '4 semesters',
                'additional_resources' => 'Curriculum modernization, software training for teachers'
            ],
        ];
    }
}
