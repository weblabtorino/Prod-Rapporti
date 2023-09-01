<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SottoIntervento extends Model
{
    use HasFactory;

    protected $fillable = ['data','ora_inizio','ora_fine','descrizione','intervento_id'];

    public function intervento()
    {
        return $this->belongsTo(Interventi::class);
    }
}
