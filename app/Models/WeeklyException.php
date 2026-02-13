<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read \App\Models\WeeklySession|null $weeklySession
 * @method static \Database\Factories\WeeklyExceptionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyException newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyException newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyException query()
 * @mixin \Eloquent
 */
class WeeklyException extends Model
{

    use HasFactory;

    protected $fillable = [
        'weekly_session_id',
        'exception_date',
        'reason',
        'is_cancelled',
    ];

    protected function casts(): array
    {
        return [
            'exception_date' => 'date',
            'is_cancelled' => 'boolean',
        ];
    }

    // Relationships
    public function weeklySession(): BelongsTo
    {
        return $this->belongsTo(WeeklySession::class);
    }
}
