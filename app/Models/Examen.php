<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;
    protected $fillable = [
        'session',
        'duree',
        'module_id',
        'local_id',
        'crenau_id',
    ];



    // relation pour la relier avec module :
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // relation avec ensieignant :
    public function enseignants()
    {
        return $this->belongsToMany(User::class,'examens_enseignants');
    }

    // relation avec local :
    public function local()
    {
        return $this->belongsTo(Local::class);
    }

    // le relier avec groupe :
    public function groupes()
    {
        return $this->belongsToMany(Groupe::class,'examens_groupes');

    }

    // le relier avec crenaux :
    public function crenau()
    {
       return $this->belongsTo(Crenau::class);
    }
}

