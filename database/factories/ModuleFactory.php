<?php

namespace Database\Factories;

use App\Models\Module;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    // Real CFPA modules for IT specialty
    private static $modules = [
        ['ar' => 'برمجة الويب', 'fr' => 'Développement Web', 'code' => 'MWD', 'coef' => 3, 'theory' => 40, 'practice' => 60],
        ['ar' => 'قواعد البيانات', 'fr' => 'Bases de Données', 'code' => 'MBD', 'coef' => 3, 'theory' => 35, 'practice' => 65],
        ['ar' => 'الشبكات', 'fr' => 'Réseaux Informatiques', 'code' => 'MRI', 'coef' => 2, 'theory' => 30, 'practice' => 50],
        ['ar' => 'نظام التشغيل', 'fr' => 'Systèmes d\'Exploitation', 'code' => 'MSE', 'coef' => 2, 'theory' => 40, 'practice' => 40],
        ['ar' => 'البرمجة بلغة جافا', 'fr' => 'Programmation Java', 'code' => 'MPJ', 'coef' => 3, 'theory' => 30, 'practice' => 70],
        ['ar' => 'الأمن المعلوماتي', 'fr' => 'Sécurité Informatique', 'code' => 'MSI', 'coef' => 2, 'theory' => 50, 'practice' => 30],
        ['ar' => 'اللغة الفرنسية', 'fr' => 'Langue Française', 'code' => 'MLF', 'coef' => 1, 'theory' => 80, 'practice' => 0],
        ['ar' => 'اللغة الإنجليزية', 'fr' => 'Langue Anglaise', 'code' => 'MLA', 'coef' => 1, 'theory' => 80, 'practice' => 0],
        ['ar' => 'الرياضيات التطبيقية', 'fr' => 'Mathématiques Appliquées', 'code' => 'MMA', 'coef' => 2, 'theory' => 70, 'practice' => 10],
        ['ar' => 'تقنيات الاتصال', 'fr' => 'Techniques de Communication', 'code' => 'MTC', 'coef' => 1, 'theory' => 60, 'practice' => 20],
    ];

    private static $counter = 0;

    public function definition(): array
    {
        $module = self::$modules[self::$counter % count(self::$modules)];
        self::$counter++;

        return [
            'class_id' => ClassModel::factory(),
            'code' => $module['code'],
            'name_ar' => $module['ar'],
            'name_fr' => $module['fr'],
            'coefficient' => $module['coef'],
            'hours_theory' => $module['theory'],
            'hours_practice' => $module['practice'],
        ];
    }
}
