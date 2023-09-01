<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fatture extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'intervento_id', 'data_fattura', 'totale', 'stato'
    ];

    public function cliente()
    {
        return $this->belongsTo(Clienti::class);
    }

    public function intervento()
    {
        return $this->belongsTo(Interventi::class);
    }
}
