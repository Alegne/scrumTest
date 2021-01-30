<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;


    //relation entre les tables
    public function activite()
    {
        return $this->belongsTo(Activite::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }
}
