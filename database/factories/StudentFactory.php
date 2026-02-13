<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    // Real Algerian first names
    private static $firstNamesMale = [
        'محمد',
        'أحمد',
        'عبد الله',
        'يوسف',
        'إبراهيم',
        'خالد',
        'عمر',
        'علي',
        'حسن',
        'سعيد',
        'كريم',
        'رامي',
        'ياسين',
        'بلال',
        'عبد الرحمن',
        'أنس',
        'زكريا',
        'طارق',
        'وليد',
        'رضا'
    ];

    private static $firstNamesFemale = [
        'فاطمة',
        'عائشة',
        'خديجة',
        'مريم',
        'زينب',
        'سارة',
        'هدى',
        'نور',
        'ليلى',
        'أمينة',
        'ياسمين',
        'سلمى',
        'إيمان',
        'حنان',
        'نادية',
        'سميرة',
        'كريمة',
        'رانيا',
        'هاجر',
        'إكرام'
    ];

    private static $lastNames = [
        'بن علي',
        'بوعزة',
        'مرابط',
        'بلعباس',
        'بن عيسى',
        'حمدي',
        'زروقي',
        'بوزيد',
        'مزياني',
        'قاسمي',
        'بن صالح',
        'عماري',
        'بلقاسم',
        'شريف',
        'بوشامة',
        'دحماني',
        'بوعلام',
        'لعروسي',
        'بن يوسف',
        'كريم'
    ];

    // Algerian wilayas for matricule
    private static $wilayas = ['01', '16', '09', '31', '23', '10', '15', '13', '25', '34'];

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $isApprentice = $this->faker->boolean(30); // 30% apprentice
        $wilaya = $this->faker->randomElement(self::$wilayas);
        $year = date('y');
        $sequential = str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);

        if ($gender === 'male') {
            $firstNameAr = $this->faker->randomElement(self::$firstNamesMale);
            $firstNameFr = $this->transliterate($firstNameAr);
        } else {
            $firstNameAr = $this->faker->randomElement(self::$firstNamesFemale);
            $firstNameFr = $this->transliterate($firstNameAr);
        }

        $lastNameAr = $this->faker->randomElement(self::$lastNames);
        $lastNameFr = $this->transliterate($lastNameAr);

        return [
            'matricule' => "CFPA{$wilaya}{$year}{$sequential}",
            'first_name_ar' => $firstNameAr,
            'last_name_ar' => $lastNameAr,
            'first_name_fr' => $firstNameFr,
            'last_name_fr' => $lastNameFr,
            'email' => strtolower($firstNameFr . '.' . str_replace(' ', '', $lastNameFr)) . '@example.dz',
            'phone' => '0' . $this->faker->randomElement(['5', '6', '7']) . $this->faker->numerify('########'),
            'birth_date' => $this->faker->dateTimeBetween('-25 years', '-18 years'),
            'gender' => $gender,
            'formation_type' => $isApprentice ? 'apprentice' : $this->faker->randomElement(['presential', 'remote']),
            'company_name' => $isApprentice ? $this->faker->randomElement([
                'SONELGAZ',
                'Ooredoo',
                'Djezzy',
                'NAFTAL',
                'Air Algérie',
                'CEVITAL',
                'Condor Electronics'
            ]) : null,
            'company_address' => $isApprentice ? $this->faker->city() . ', Algérie' : null,
            'group_id' => null, // Will be set in seeder
            'status' => 'active',
            'entry_date' => now()->subMonths($this->faker->numberBetween(1, 12)),
        ];
    }

    private function transliterate(string $arabic): string
    {
        $map = [
            'محمد' => 'Mohamed',
            'أحمد' => 'Ahmed',
            'عبد الله' => 'Abdallah',
            'يوسف' => 'Youcef',
            'إبراهيم' => 'Ibrahim',
            'خالد' => 'Khaled',
            'عمر' => 'Omar',
            'علي' => 'Ali',
            'حسن' => 'Hassen',
            'سعيد' => 'Said',
            'كريم' => 'Karim',
            'رامي' => 'Rami',
            'ياسين' => 'Yacine',
            'بلال' => 'Bilal',
            'عبد الرحمن' => 'Abderrahmane',
            'فاطمة' => 'Fatima',
            'عائشة' => 'Aicha',
            'خديجة' => 'Khadidja',
            'مريم' => 'Meriem',
            'زينب' => 'Zineb',
            'سارة' => 'Sara',
            'هدى' => 'Houda',
            'نور' => 'Nour',
            'ليلى' => 'Leila',
            'أمينة' => 'Amina',
            'ياسمين' => 'Yasmine',
            'سلمى' => 'Salma',
            'بن علي' => 'Benali',
            'بوعزة' => 'Bouazza',
            'مرابط' => 'Merabt',
            'بلعباس' => 'Belabbas',
            'بن عيسى' => 'Ben Aissa',
            'حمدي' => 'Hamdi',
            'زروقي' => 'Zerrouki',
            'بوزيد' => 'Bouzid',
            'قاسمي' => 'Gasmi',
            'بن صالح' => 'Bensalah',
            'عماري' => 'Ammari',
            'بلقاسم' => 'Belkacem',
        ];

        return $map[$arabic] ?? $arabic;
    }
}
