<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class colies extends Model
{
    protected $fillable = ["Reference","Designation","id_Fournisseur","Prix","Qte_Unitaire","Qr_code"];
    use HasFactory;

    public function Fournisseur():BelongsTo {
        return $this->belongsTo(fournisseurs::class,"id_Fournisseur");
    }
    public function Destinataire():BelongsTo {
        return $this->belongsTo(destinataires::class);
    }

    public function stocks():HasMany {
        return $this->hasMany(Stock::class,"Reference","Reference_colie");
    }
}
