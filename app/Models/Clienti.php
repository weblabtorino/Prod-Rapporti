<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienti extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'telefono','prezzo_orario'];

    public function interventi()
    {
        return $this->hasMany(Interventi::class, 'cliente_id');
    }
}
