<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'etat_id'
    ];

    //relation entre les tables
    public function taches()
    {
        return $this->hasMany(Tache::classe);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

    //mutateur
    public function setNameAttribute($value){
        return $this->attributes['name'] = ucfirst($value);
    }

    public function setDescriptionAttribute($value){
        return $this->attributes['description'] = ucfirst($value);
    }
}
