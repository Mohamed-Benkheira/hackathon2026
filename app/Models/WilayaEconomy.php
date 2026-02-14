<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WilayaEconomy extends Model
{
    protected $fillable = [
        'wilaya',
        'agriculture_pct',
        'industry_pct',
        'services_pct',
        'tourism_pct',
        'population',
    ];

    public function institutes()
    {
        return $this->hasMany(Institute::class, 'wilaya', 'wilaya');
    }
}
