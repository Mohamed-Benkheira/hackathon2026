<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $first_name_ar
 * @property string $last_name_ar
 * @property string|null $first_name_fr
 * @property string|null $last_name_fr
 * @property string|null $phone
 * @property string|null $email
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name_ar
 * @property-read string $full_name_fr
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WeeklySession> $weeklySessions
 * @property-read int|null $weekly_sessions_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher active()
 * @method static \Database\Factories\TeacherFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereFirstNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereFirstNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereLastNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereLastNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Teacher extends Model
{

    use HasFactory;

    protected $fillable = [
        'first_name_ar',
        'last_name_ar',
        'first_name_fr',
        'last_name_fr',
        'phone',
        'email',
        'status',
    ];

    // Relationships
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_teachers')
            ->withPivot('role', 'assigned_date')
            ->withTimestamps();
    }

    public function weeklySessions(): HasMany
    {
        return $this->hasMany(WeeklySession::class);
    }

    // Accessors
    public function getFullNameArAttribute(): string
    {
        return $this->last_name_ar . ' ' . $this->first_name_ar;
    }

    public function getFullNameFrAttribute(): string
    {
        return $this->first_name_fr . ' ' . $this->last_name_fr;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
