<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


/**
 * @property int $id
 * @property string $matricule
 * @property string $first_name_ar
 * @property string $last_name_ar
 * @property string|null $first_name_fr
 * @property string|null $last_name_fr
 * @property string|null $email
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $birth_date
 * @property string|null $gender
 * @property string $formation_type
 * @property string|null $company_name
 * @property string|null $company_address
 * @property string|null $internship_company
 * @property \Illuminate\Support\Carbon|null $internship_start_date
 * @property \Illuminate\Support\Carbon|null $internship_end_date
 * @property int|null $group_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $entry_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name_ar
 * @property-read string $full_name_fr
 * @property-read \App\Models\Group|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ModuleGrade> $moduleGrades
 * @property-read int|null $module_grades_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student byFormationType(string $type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student byGroup(int $groupId)
 * @method static \Database\Factories\StudentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCompanyAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereEntryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFirstNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFirstNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFormationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereInternshipCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereInternshipEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereInternshipStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereLastNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereLastNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Student extends Model
{

    use HasFactory;
    protected $fillable = [
        'matricule',
        'first_name_ar',
        'last_name_ar',
        'first_name_fr',
        'last_name_fr',
        'email',
        'phone',
        'birth_date',
        'gender',
        'formation_type',
        'company_name',
        'company_address',
        'internship_company',
        'internship_start_date',
        'internship_end_date',
        'group_id',
        'status',
        'entry_date',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'internship_start_date' => 'date',
            'internship_end_date' => 'date',
            'entry_date' => 'date',
        ];
    }

    // Relationships
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function moduleGrades(): HasMany
    {
        return $this->hasMany(ModuleGrade::class);
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

    public function isApprentice(): bool
    {
        return $this->formation_type === 'apprentice';
    }

    public function isPresential(): bool
    {
        return $this->formation_type === 'presential';
    }

    public function isRemote(): bool
    {
        return $this->formation_type === 'remote';
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByFormationType($query, string $type)
    {
        return $query->where('formation_type', $type);
    }

    public function scopeByGroup($query, int $groupId)
    {
        return $query->where('group_id', $groupId);
    }
}
