<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
