<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property int $id
 * @property int $class_id
 * @property string $code
 * @property string $name_ar
 * @property string $name_fr
 * @property int $coefficient
 * @property int $hours_theory
 * @property int $hours_practice
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ClassModel $class
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read int $total_hours
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleGrade> $moduleGrades
 * @property-read int|null $module_grades_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WeeklySession> $weeklySessions
 * @property-read int|null $weekly_sessions_count
 * @method static \Database\Factories\ModuleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereHoursPractice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereHoursTheory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Module whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Module extends Model
{
    use HasFactory;


    protected $fillable = [
        'class_id',
        'code',
        'name_ar',
        'name_fr',
        'coefficient',
        'hours_theory',
        'hours_practice',
    ];

    protected function casts(): array
    {
        return [
            'coefficient' => 'integer',
            'hours_theory' => 'integer',
            'hours_practice' => 'integer',
        ];
    }

    // Relationships
    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function moduleGrades(): HasMany
    {
        return $this->hasMany(ModuleGrade::class);
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
    public function getTotalHoursAttribute(): int
    {
        return $this->hours_theory + $this->hours_practice;
    }
}
