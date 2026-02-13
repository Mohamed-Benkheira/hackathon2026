<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $specialty_id
 * @property int $semester_number
 * @property string $certificate
 * @property string|null $name_ar
 * @property string|null $name_fr
 * @property int|null $duration_months
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamSession> $examSessions
 * @property-read int|null $exam_sessions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Module> $modules
 * @property-read int|null $modules_count
 * @property-read \App\Models\Specialty $specialty
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel bySemester(int $semester)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereDurationMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereSemesterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ClassModel whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'specialty_id',
        'semester_number',
        'certificate',
        'name_ar',
        'name_fr',
        'duration_months',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function specialty(): BelongsTo
    {
        return $this->belongsTo(Specialty::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class, 'class_id');
    }

    public function modules(): HasMany
    {
        return $this->hasMany(Module::class, 'class_id');
    }

    public function examSessions(): HasMany
    {
        return $this->hasMany(ExamSession::class, 'class_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeBySemester($query, int $semester)
    {
        return $query->where('semester_number', $semester);
    }
}
