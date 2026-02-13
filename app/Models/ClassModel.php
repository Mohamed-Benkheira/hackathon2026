<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'specialty_id',
        'semester_number',
        'certificate',
        'name_ar',
        'name_fr',
        'duration_months',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'class_id');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'class_id');
    }

    public function examSessions(): HasMany
    {
        return $this->hasMany(ExamSession::class, 'class_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySemester($query, int $semester)
    {
        return $query->where('semester_number', $semester);
    }
}
