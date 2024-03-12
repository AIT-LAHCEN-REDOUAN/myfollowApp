<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class permissions extends Model
{
    use HasFactory;

    public function role():BelongsToMany{
        return $this->belongsToMany(role::class);
    }
}
