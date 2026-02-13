<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $modules = [
            ['code' => 'M01', 'name_ar' => 'البرمجة', 'name_fr' => 'Programmation', 'coef' => 3],
            ['code' => 'M02', 'name_ar' => 'قواعد البيانات', 'name_fr' => 'Base de Données', 'coef' => 2],
            ['code' => 'M03', 'name_ar' => 'الشبكات', 'name_fr' => 'Réseaux', 'coef' => 2],
            ['code' => 'M04', 'name_ar' => 'تطوير الويب', 'name_fr' => 'Développement Web', 'coef' => 3],
        ];

        $classes = \DB::table('classes')->get();

        foreach ($classes as $class) {
            foreach ($modules as $module) {
                Module::create([
                    'institute_id' => $class->institute_id,
                    'class_id' => $class->id,
                    'code' => $module['code'],
                    'name_ar' => $module['name_ar'],
                    'name_fr' => $module['name_fr'],
                    'coefficient' => $module['coef'],
                    'hours_theory' => 40,
                    'hours_practice' => 20,
                ]);
            }
        }
    }
}
