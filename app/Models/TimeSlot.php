<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\BelongsToInstitute;

class TimeSlot extends Model
{
    use BelongsToInstitute;

    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'exam_session_id',
        'exam_date',
        'slot_number',
        'start_time',
        'end_time',
    ];

    protected function casts(): array
    {
        return [
            'exam_date' => 'date',
        ];
    }

    // Relationships
    public function examSession(): BelongsTo
    {
        return $this->belongsTo(ExamSession::class);
    }

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    // Accessors
    public function getDurationMinutesAttribute(): int
    {
        $start = \Carbon\Carbon::parse($this->start_time);
        $end = \Carbon\Carbon::parse($this->end_time);
        return $end->diffInMinutes($start);
    }
}
