<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;


    //relation entre les tables
    public function activites()
    {
        return $this->hasMany(Activite::class);
    }

    public function taches()
    {
        return $this->hasMany(Tache::class);
    }
}
