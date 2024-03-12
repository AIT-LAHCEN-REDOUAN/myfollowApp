<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class destinataires extends Model
{
    protected $fillable = ["name","email","Telephone"];
    use HasFactory;


    public function colie():HasMany {
        return $this->hasMany(colie::class);
    }
}
