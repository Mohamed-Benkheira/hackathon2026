<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;




/**
 * @property int $id
 * @property string $name_ar
 * @property string $name_fr
 * @property string $code
 * @property string $role
 * @property array<array-key, mixed>|null $certificate_types
 * @property int|null $duration_months
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ClassModel> $classes
 * @property-read int|null $classes_count
 * @method static \Database\Factories\SpecialtyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCertificateTypes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereDurationMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereNameAr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereNameFr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Specialty extends Model
{


    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_fr',
        'code',
        'formation_types',
        'certificate_types',
        'duration_months',
    ];

    protected function casts(): array
    {
        return [
            'formation_types' => 'array',
            'certificate_types' => 'array',
        ];
    }

    public function classes(): HasMany
    {
        return $this->hasMany(ClassModel::class);
    }
}
