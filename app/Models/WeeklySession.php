<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WeeklyException> $exceptions
 * @property-read int|null $exceptions_count
 * @property-read string $day_name
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\Module|null $module
 * @property-read \App\Models\Room|null $room
 * @property-read \App\Models\Teacher|null $teacher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession byDay(int $day)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession byTeacher(int $teacherId)
 * @method static \Database\Factories\WeeklySessionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklySession query()
 * @mixin \Eloquent
 */
class WeeklySession extends Model
{
    use HasFactory;


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


