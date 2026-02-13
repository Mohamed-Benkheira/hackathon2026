<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModuleGrade extends Model
{
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
