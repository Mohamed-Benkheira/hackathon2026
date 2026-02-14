<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;

class TeacherAllocation extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-user-group';
    protected string $view = 'filament.pages.teacher-allocation';
    protected static ?string $navigationLabel = 'Teacher Allocation';
    protected static ?string $title = '👨‍🏫 Teacher Allocation Strategy';
    protected static ?int $navigationSort = 4;
    protected static UnitEnum|string|null $navigationGroup = 'AI Recommendations';


    public static function canAccess(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    public function getRecommendations(): array
    {
        return [
            [
                'issue' => 'Unbalanced Student-Teacher Ratio',
                'from_institute' => 'INSFP Alger',
                'to_institute' => 'INSFP Sétif',
                'current_ratio_from' => '18:1',
                'current_ratio_to' => '42:1',
                'target_ratio' => '28:1 both',
                'teachers_to_move' => 4,
                'specialties' => ['Industrial Maintenance', 'Electronics'],
                'impact' => 'Will improve Sétif success rate by estimated 12%',
                'priority' => 'Critical'
            ],
            [
                'issue' => 'Underutilized Teaching Capacity',
                'from_institute' => 'INSFP Tlemcen',
                'to_institute' => 'INSFP Oran',
                'current_ratio_from' => '15:1',
                'current_ratio_to' => '38:1',
                'target_ratio' => '25:1 both',
                'teachers_to_move' => 3,
                'specialties' => ['Accounting', 'Management'],
                'impact' => 'Better resource utilization, reduce Oran teacher workload',
                'priority' => 'High'
            ],
            [
                'issue' => 'Specialty Expertise Gap',
                'from_institute' => 'INSFP Béjaïa',
                'to_institute' => 'INSFP Constantine',
                'current_ratio_from' => '22:1',
                'current_ratio_to' => '35:1',
                'target_ratio' => '27:1 both',
                'teachers_to_move' => 2,
                'specialties' => ['Agricultural Engineering'],
                'impact' => 'Fill critical agriculture specialty gap in Constantine',
                'priority' => 'High'
            ],
        ];
    }
}
