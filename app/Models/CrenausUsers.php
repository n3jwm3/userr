<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrenausUsers extends Model
{
    use HasFactory;
<<<<<<< HEAD:app/Models/CrenausUsers.php
    
=======
   

>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b:app/Models/CrenausEnseignants.php
    protected $fillable = [
        'crenau_id', 'user_id',
    ];
    
    public function crenau()
    {
        return $this->belongsTo(Crenau::class, 'crenau_id');
    }
}
