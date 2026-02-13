<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Concerns\BelongsToInstitute;

class Teacher extends Model
{
    use BelongsToInstitute;

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
