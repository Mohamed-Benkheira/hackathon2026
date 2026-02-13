<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property int $student_id
 * @property int $module_id
 * @property numeric|null $controle1
 * @property numeric|null $controle2
 * @property numeric|null $examen_final
 * @property numeric|null $moyenne_module
 * @property int $coefficient
 * @property numeric|null $moyenne_ponderee
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Module $module
 * @property-read \App\Models\Student $student
 * @method static \Database\Factories\ModuleGradeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade failed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade passed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereCoefficient($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereControle1($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereControle2($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereExamenFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereModuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereMoyenneModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereMoyennePonderee($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ModuleGrade whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ModuleGrade extends Model
{


    use HasFactory;

    protected $fillable = [
        'student_id',
        'module_id',
        'controle1',
        'controle2',
        'examen_final',
        'coefficient',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'controle1' => 'decimal:2',
            'controle2' => 'decimal:2',
            'examen_final' => 'decimal:2',
            'moyenne_module' => 'decimal:2',
            'moyenne_ponderee' => 'decimal:2',
            'coefficient' => 'integer',
        ];
    }

    // Relationships
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    // Helper methods
    public function isPassed(): bool
    {
        return $this->moyenne_module >= 10;
    }

    public function calculateMoyenne(): ?float
    {
        if ($this->controle1 && $this->controle2 && $this->examen_final) {
            return round(($this->controle1 + $this->controle2 + $this->examen_final) / 3, 2);
        }
        return null;
    }

    // Scopes
    public function scopePassed($query)
    {
        return $query->whereRaw('moyenne_module >= 10');
    }

    public function scopeFailed($query)
    {
        return $query->whereRaw('moyenne_module < 10');
    }
}
