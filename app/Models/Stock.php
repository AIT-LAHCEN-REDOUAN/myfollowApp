<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ["id","Reference_colie","Quantite_disponible","id_fournisseur","prix"];

    public function colie():BelongsTo {
        return $this->belongsTo(colies::class,"Reference_colie","Reference");
    }
}
