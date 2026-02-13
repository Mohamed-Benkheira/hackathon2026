<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    private static $titles = ['أستاذ', 'مهندس', 'دكتور', 'السيد'];
    private static $titlesFr = ['Mr', 'Mme', 'Dr', 'Ing'];

    private static $firstNames = [
        'محمد',
        'أحمد',
        'فاطمة',
        'كمال',
        'نادية',
        'رشيد',
        'سعاد',
        'حميد',
        'زهرة',
        'عبد القادر'
    ];

    private static $lastNames = [
        'بن عمر',
        'مزياني',
        'بوزيد',
        'لعروسي',
        'بن عيسى',
        'زروقي',
        'عماري',
        'قاسمي',
        'شريف',
        'حمدي'
    ];

    public function definition(): array
    {
        $firstNameAr = $this->faker->randomElement(self::$firstNames);
        $lastNameAr = $this->faker->randomElement(self::$lastNames);

        return [
            'first_name_ar' => $firstNameAr,
            'last_name_ar' => $lastNameAr,
            'first_name_fr' => $this->transliterate($firstNameAr),
            'last_name_fr' => $this->transliterate($lastNameAr),
            'phone' => '0' . $this->faker->randomElement(['5', '6', '7']) . $this->faker->numerify('########'),
            'email' => strtolower(substr($this->transliterate($firstNameAr), 0, 1) . $this->transliterate($lastNameAr)) . '@cfpa.dz',
            'status' => 'active',
        ];
    }

    private function transliterate(string $arabic): string
    {
        $map = [
            'محمد' => 'Mohamed',
            'أحمد' => 'Ahmed',
            'فاطمة' => 'Fatima',
            'كمال' => 'Kamel',
            'نادية' => 'Nadia',
            'رشيد' => 'Rachid',
            'سعاد' => 'Souad',
            'حميد' => 'Hamid',
            'زهرة' => 'Zohra',
            'عبد القادر' => 'Abdelkader',
            'بن عمر' => 'Benomar',
            'مزياني' => 'Meziani',
            'بوزيد' => 'Bouzid',
            'لعروسي' => 'Larousi',
            'بن عيسى' => 'Ben Aissa',
            'زروقي' => 'Zerrouki',
            'عماري' => 'Ammari',
            'قاسمي' => 'Gasmi',
            'شريف' => 'Cherif',
            'حمدي' => 'Hamdi',
        ];

        return $map[$arabic] ?? $arabic;
    }
}
