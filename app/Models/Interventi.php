<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interventi extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'descrizione', 'ore_lavorate', 'prezzo_orario', 'totale', 'data_inizio', 'data_fine', 'stato','fatturato'];
    protected $dates = ['data_inizio', 'data_fine'];

    public function cliente()
    {
        return $this->belongsTo(Clienti::class, 'cliente_id');
    }
    public function sottoInterventi()
    {
        return $this->hasMany(SottoIntervento::class,'intervento_id');
    }

    public function costiAggiuntivi()
    {
        return $this->hasMany(CostoAggiuntivo::class, 'intervento_id');
    }
}

