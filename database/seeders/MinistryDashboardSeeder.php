<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Institute, WilayaEconomy, Specialty};

class MinistryDashboardSeeder extends Seeder
{
    public function run(): void
    {
        // Algerian wilayas with economic profiles
        $wilayasData = [
            [
                'name' => 'Alger',
                'agri' => 5,
                'ind' => 25,
                'services' => 60,
                'tourism' => 10,
                'pop' => 3500000
            ],
            [
                'name' => 'Oran',
                'agri' => 8,
                'ind' => 30,
                'services' => 52,
                'tourism' => 10,
                'pop' => 1500000
            ],
            [
                'name' => 'Constantine',
                'agri' => 12,
                'ind' => 28,
                'services' => 50,
                'tourism' => 10,
                'pop' => 950000
            ],
            [
                'name' => 'Sétif',
                'agri' => 35,
                'ind' => 25,
                'services' => 35,
                'tourism' => 5,
                'pop' => 1500000
            ],
            [
                'name' => 'Béjaïa',
                'agri' => 20,
                'ind' => 35,
                'services' => 35,
                'tourism' => 10,
                'pop' => 950000
            ],
            [
                'name' => 'Tlemcen',
                'agri' => 25,
                'ind' => 20,
                'services' => 40,
                'tourism' => 15,
                'pop' => 950000
            ],
        ];

        // Create wilaya economies
        foreach ($wilayasData as $w) {
            WilayaEconomy::create([
                'wilaya' => $w['name'],
                'agriculture_pct' => $w['agri'],
                'industry_pct' => $w['ind'],
                'services_pct' => $w['services'],
                'tourism_pct' => $w['tourism'],
                'population' => $w['pop'],
            ]);
        }

        // Update existing institutes with wilaya info
        $institutes = Institute::all();

        foreach ($institutes as $index => $inst) {
            $wilayaData = $wilayasData[$index % count($wilayasData)];

            $inst->update([
                'name' => 'INSFP ' . $wilayaData['name'],
                'wilaya' => $wilayaData['name'],
                'code' => 'INSFP-' . str_pad($inst->id, 2, '0', STR_PAD_LEFT),
                'capacity' => rand(400, 800),
            ]);
        }

        // Add more realistic specialties with sector codes
        $sectorSpecialties = [
            // Agriculture codes start with AGR
            ['name_ar' => 'الفلاحة والري', 'name_fr' => 'Agriculture et Irrigation', 'code' => 'AGR01', 'role' => 'presential'],
            ['name_ar' => 'ميكانيك الفلاحة', 'name_fr' => 'Mécanique Agricole', 'code' => 'AGR02', 'role' => 'apprentice'],

            // Industry codes start with IND
            ['name_ar' => 'الصيانة الصناعية', 'name_fr' => 'Maintenance Industrielle', 'code' => 'IND01', 'role' => 'presential'],
            ['name_ar' => 'الكهرباء الصناعية', 'name_fr' => 'Électricité Industrielle', 'code' => 'IND02', 'role' => 'apprentice'],

            // Tourism codes start with TOUR
            ['name_ar' => 'الفندقة والسياحة', 'name_fr' => 'Hôtellerie et Tourisme', 'code' => 'TOUR01', 'role' => 'presential'],
        ];

        // Add sector-based specialties to some institutes
        foreach (Institute::limit(3)->get() as $institute) {
            foreach ($sectorSpecialties as $spec) {
                Specialty::create([
                    'institute_id' => $institute->id,
                    'name_ar' => $spec['name_ar'],
                    'name_fr' => $spec['name_fr'],
                    'code' => $spec['code'] . '-' . $institute->id,
                    'role' => $spec['role'],
                    'certificate_types' => json_encode(['TS', 'CMP']),
                    'duration_months' => 24,
                ]);
            }
        }

        $this->command->info('✅ Ministry data seeded successfully!');
    }
}
