<?php

namespace Database\Factories;

use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialtyFactory extends Factory
{
    protected $model = Specialty::class;

    // Real Algerian CFPA specialties
    private static $specialties = [
        ['ar' => 'تقني سامي في الإعلام الآلي', 'fr' => 'Technicien Supérieur en Informatique', 'code' => 'TSI', 'role' => 'presential', 'cert' => ['TS', 'BTS']],
        ['ar' => 'تقني في الإعلام الآلي', 'fr' => 'Technicien en Informatique', 'code' => 'TI', 'role' => 'presential', 'cert' => ['BT', 'CMP']],
        ['ar' => 'تقني سامي في المحاسبة والتسيير', 'fr' => 'Technicien Supérieur en Comptabilité', 'code' => 'TSCT', 'role' => 'presential', 'cert' => ['TS', 'BTS']],
        ['ar' => 'تقني في الكهرباء الصناعية', 'fr' => 'Technicien en Electricité Industrielle', 'code' => 'TEI', 'role' => 'apprentice', 'cert' => ['BT', 'CMP']],
        ['ar' => 'تقني سامي في الصيانة الصناعية', 'fr' => 'Technicien Supérieur en Maintenance Industrielle', 'code' => 'TSMI', 'role' => 'apprentice', 'cert' => ['TS', 'BTS']],
        ['ar' => 'تقني في الطبخ', 'fr' => 'Technicien en Cuisine', 'code' => 'TC', 'role' => 'presential', 'cert' => ['CMP', 'CAP']],
        ['ar' => 'تقني سامي في البناء', 'fr' => 'Technicien Supérieur en Bâtiment', 'code' => 'TSB', 'role' => 'presential', 'cert' => ['TS', 'BTS']],
        ['ar' => 'تقني في اللحام', 'fr' => 'Technicien en Soudure', 'code' => 'TS', 'role' => 'apprentice', 'cert' => ['CMP', 'CAP']],
        ['ar' => 'تقني في الخياطة', 'fr' => 'Technicien en Couture', 'code' => 'TCO', 'role' => 'presential', 'cert' => ['CMP', 'CAP']],
        ['ar' => 'تقني سامي في الأمن الصناعي', 'fr' => 'Technicien Supérieur en Sécurité Industrielle', 'code' => 'TSSI', 'role' => 'remote', 'cert' => ['TS', 'BTS']],
    ];

    private static $counter = 0;

    public function definition(): array
    {
        $specialty = self::$specialties[self::$counter % count(self::$specialties)];
        self::$counter++;

        return [
            'name_ar' => $specialty['ar'],
            'name_fr' => $specialty['fr'],
            'code' => $specialty['code'],
            'role' => $specialty['role'],
            'certificate_types' => $specialty['cert'],
            'duration_months' => in_array('TS', $specialty['cert']) ? 30 : 18,
        ];
    }
}
