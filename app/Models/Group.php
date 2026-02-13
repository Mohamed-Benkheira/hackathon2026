<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'name',
        'capacity',
        'current_students',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'current_students' => 'integer',
        ];
    }

    // Relationships
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class, 'group_teachers')
            ->withPivot('role', 'assigned_date')
            ->withTimestamps();
    }

    public function modules()
    {
        return $this->hasManyThrough(
            Module::class,
            ClassModel::class,
            'id',           // Foreign key on classes
            'class_id',     // Foreign key on modules  
            'class_id',     // Local key on groups
            'id'            // Local key on classes
        );
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
    public function getFullNameAttribute(): string
    {
        return $this->class->name_ar . ' - ' . $this->name;
    }

    public function getAvailableSeatsAttribute(): int
    {
        return $this->capacity - $this->current_students;
    }

    // Scopes
    public function scopeWithCapacity($query)
    {
        return $query->whereColumn('current_students', '<', 'capacity');
    }
}
