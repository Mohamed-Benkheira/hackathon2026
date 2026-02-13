<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\BelongsToInstitute;


class Student extends Model
{
    use BelongsToInstitute;

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
