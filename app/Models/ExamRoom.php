<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\Exam|null $exam
 * @property-read \App\Models\Room|null $room
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRoom newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRoom newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRoom query()
 * @mixin \Eloquent
 */
class ExamRoom extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'room_id',
        'seats_used',
    ];

    protected function casts(): array
    {
        return [
            'seats_used' => 'integer',
        ];
    }

    // Relationships
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
