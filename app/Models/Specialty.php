<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Specialty extends Model
{
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

    // Relationships
    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
}
