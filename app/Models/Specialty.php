<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Concerns\BelongsToInstitute;


class Specialty extends Model
{
    use BelongsToInstitute;
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_fr',
        'code',
        'formation_types',
        'certificate_types',
        'duration_months',
    ];

    protected function casts(): array
    {
        return [
            'formation_types' => 'array',
            'certificate_types' => 'array',
        ];
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
    public function students()
    {
        return $this->hasManyThrough(
            Student::class,
            ClassModel::class,
            'specialty_id', // Foreign key on classes table
            'group_id',     // Foreign key on students table
            'id',           // Local key on specialties table
            'id'            // Local key on classes table
        )->join('groups', 'students.group_id', '=', 'groups.id')
            ->join('classes', 'groups.class_id', '=', 'classes.id');
    }

}
