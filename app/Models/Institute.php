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
}
