<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class roles extends Model
{
    protected $fillable = ["name","guardName"];
    use HasFactory;

    public function user():BelongsToMany{
        return $this->belongsToMany(User::class,"id");
    }
    public function permissions():HasMany{
        return $this->hasMany(permissions::class);
    }
}
