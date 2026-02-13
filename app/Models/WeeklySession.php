<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeeklySession extends Model
{
    protected $fillable = [
        'group_id',
        'module_id',
        'teacher_id',
        'day_of_week',
        'slot_start',
        'slot_end',
        'slot_number',
        'session_type',
        'room_id',
        'is_active',
        'week_repeats',
    ];

    protected function casts(): array
    {
        return [
            'day_of_week' => 'integer',
            'slot_number' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function exceptions(): HasMany
    {
        return $this->hasMany(WeeklyException::class);
    }

    // Accessors
    public function getDayNameAttribute(): string
    {
        $days = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
        ];
        return $days[$this->day_of_week] ?? 'Unknown';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDay($query, int $day)
    {
        return $query->where('day_of_week', $day);
    }

    public function scopeByTeacher($query, int $teacherId)
    {
        return $query->where('teacher_id', $teacherId);
    }
}
