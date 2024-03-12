<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class fournisseurs extends Model
{
    protected $fillable = ["name","email","Telephone"];
    use HasFactory;

    public function colie():HasMany{
        return $this->hasMany(colie::class,"id_Founisseur");
    }

    public function tracabilities():HasMany{
        return $this->hasMany(Suivi_de_tracabilites::class,"id_founisseur");
    }

}
