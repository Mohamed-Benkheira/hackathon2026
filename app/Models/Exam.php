<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
