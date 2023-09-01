<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostoAggiuntivo extends Model
{
    protected $table = 'costi_aggiuntivi';
    protected $fillable = ['intervento_id', 'descrizione', 'importo'];

    public function intervento() {
        return $this->belongsTo('App\Interventi');
    }
}
