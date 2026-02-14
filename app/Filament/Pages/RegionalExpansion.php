<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use UnitEnum;
use BackedEnum;
class RegionalExpansion extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-map-pin';
    protected string $view = 'filament.pages.regional-expansion';
    protected static ?string $navigationLabel = 'Regional Expansion';
    protected static ?string $title = '🗺️ Regional Expansion Strategy';
    protected static ?int $navigationSort = 2;
    protected static UnitEnum|string|null $navigationGroup = 'AI Recommendations';

    public static function canAccess(): bool
    {
        return auth()->user()->role === 'super_admin';
    }

    public function getRecommendations(): array
    {
        return [
            [
                'wilaya' => 'Ghardaïa',
                'priority' => 'High',
                'reason' => 'Population of 450,000 with no vocational training institute',
                'economic_focus' => 'Agriculture (45%), Tourism (25%)',
                'recommended_specialties' => ['Agricultural Mechanics', 'Hotel Management', 'Traditional Crafts'],
                'estimated_students' => 900,
                'investment_needed' => '120 Million DZD',
                'timeline' => '18-24 months',
                'impact_score' => 95
            ],
            [
                'wilaya' => 'Djelfa',
                'priority' => 'High',
                'reason' => 'Underserved region with growing population (1.2M)',
                'economic_focus' => 'Agriculture (55%), Construction (20%)',
                'recommended_specialties' => ['Civil Engineering', 'Agribusiness', 'Heavy Equipment Operation'],
                'estimated_students' => 1200,
                'investment_needed' => '150 Million DZD',
                'timeline' => '24 months',
                'impact_score' => 92
            ],
            [
                'wilaya' => 'Tamanrasset',
                'priority' => 'Medium',
                'reason' => 'Strategic southern location, tourism potential',
                'economic_focus' => 'Tourism (60%), Services (30%)',
                'recommended_specialties' => ['Tourism Management', 'Hospitality', 'Foreign Languages'],
                'estimated_students' => 500,
                'investment_needed' => '80 Million DZD',
                'timeline' => '18 months',
                'impact_score' => 78
            ],
            [
                'wilaya' => 'Skikda',
                'priority' => 'Medium',
                'reason' => 'Industrial port city with existing institute at 95% capacity',
                'economic_focus' => 'Industry (65%), Maritime (20%)',
                'recommended_specialties' => ['Maritime Engineering', 'Port Logistics', 'Industrial Maintenance'],
                'estimated_students' => 800,
                'investment_needed' => '110 Million DZD',
                'timeline' => '20 months',
                'impact_score' => 85
            ],
        ];
    }
}
