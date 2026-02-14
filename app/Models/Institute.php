<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\BelongsToInstitute;
class Institute extends Model
{
    use HasFactory;
    use BelongsToInstitute;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function wilayaEconomy()
    {
        return $this->belongsTo(WilayaEconomy::class, 'wilaya', 'wilaya');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

    public function specialties()
    {
        return $this->hasMany(Specialty::class);
    }
}
