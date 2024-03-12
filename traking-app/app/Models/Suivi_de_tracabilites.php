<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Suivi_de_tracabilites extends Model
{
    use HasFactory;

    protected $fillable =["id","Reference_colie","Quantite_apres_traitement","Quantite_avant_traitement","id_user","motif","raison","etat","statut","Quantite_sortie","Quantite_Retour","prix"];

    public function colie(): BelongsTo
    {
        return $this->belongsTo(colies::class,'Reference_colie','Reference');
    }

    public function user():BelongsTo {
        return $this->belongsTo(User::class,"id_user","id");
    }
    public function fournisseur(): BelongsTo
    {
    return $this->belongsTo(fournisseurs::class, 'id_fournisseur');
    }

    public function destinataire():BelongsTo {
        return $this->belongsTo(destinataires::class,"id_destinataire","id");
    }



}
