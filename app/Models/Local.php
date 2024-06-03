<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'capacite',
        'type',
    ];

// focntion pour relier avec crenaux :
public function crenaus()
{
    return $this->belongsToMany(Crenau::class);
}

// relation evace examen :
public function examens()
{
    return $this->hasMany(Examen::class);
}

}
