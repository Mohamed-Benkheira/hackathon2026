<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read \App\Models\ExamSession|null $examSession
 * @property-read \App\Models\Group|null $group
 * @property-read \App\Models\Module|null $module
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Room> $rooms
 * @property-read int|null $rooms_count
 * @property-read \App\Models\TimeSlot|null $timeSlot
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam byDate($date)
 * @method static \Database\Factories\ExamFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam scheduled()
 * @mixin \Eloquent
 */
class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'exam_session_id',
        'module_id',
        'group_id',
        'time_slot_id',
        'student_count',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'student_count' => 'integer',
        ];
    }

    // Relationships
    public function examSession(): BelongsTo
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class, 'exam_rooms')
            ->withPivot('seats_used');
    }

    // Scopes
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereHas('timeSlot', function ($q) use ($date) {
            $q->whereDate('exam_date', $date);
        });
    }
}
