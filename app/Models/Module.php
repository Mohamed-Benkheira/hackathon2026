<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    protected $fillable = [
        'class_id',
        'code',
        'name_ar',
        'name_fr',
        'coefficient',
        'hours_theory',
        'hours_practice',
    ];

    protected function casts(): array
    {
        return [
            'coefficient' => 'integer',
            'hours_theory' => 'integer',
            'hours_practice' => 'integer',
        ];
    }

    // Relationships
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function moduleGrades(): HasMany
    {
        return $this->hasMany(ModuleGrade::class);
    }

    public function weeklySessions(): HasMany
    {
        return $this->hasMany(WeeklySession::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    // Accessors
    public function getTotalHoursAttribute(): int
    {
        return $this->hours_theory + $this->hours_practice;
    }
}
