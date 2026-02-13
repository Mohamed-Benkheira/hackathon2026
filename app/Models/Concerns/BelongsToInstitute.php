<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait BelongsToInstitute
{
    protected static function bootBelongsToInstitute(): void
    {
        // Auto-scope all queries to user's institute
        static::addGlobalScope('institute', function (Builder $query) {
            if (auth()->check() && auth()->user()?->institute_id) {
                $query->where('institute_id', auth()->user()->institute_id);
            }
        });

        // Auto-fill institute_id on create
        static::creating(function (Model $model) {
            if (auth()->check() && auth()->user()?->institute_id && empty($model->institute_id)) {
                $model->institute_id = auth()->user()->institute_id;
            }
        });
    }

    public function institute()
    {
        return $this->belongsTo(\App\Models\Institute::class);
    }
}
