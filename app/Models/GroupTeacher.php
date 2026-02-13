<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property int $id
 * @property int $group_id
 * @property int $teacher_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $assigned_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Group $group
 * @property-read \App\Models\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereAssignedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GroupTeacher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GroupTeacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'teacher_id',
        'role',
        'assigned_date',
    ];

    protected function casts(): array
    {
        return [
            'assigned_date' => 'date',
        ];
    }

    // Relationships
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
}
