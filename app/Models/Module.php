<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
        'semsetre',
    ];



    // focntion pour relier au enseignant :
    public function users()
    {
        return $this->belongsToMany(User::class,'users_modules');
    }

    // la focntion pour relier les module et examen :
    public function examens()
    {
        return $this->hasMany(Examen::class);
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

}
