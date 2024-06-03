<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamensGroupes extends Model
{
    use HasFactory;

    // le relier avec examen :
    public function examen()
    {
        return $this->belongTo(Examen::class);
    }
    // le relier avec groupe :
    public function groupe()
    {
        return $this->belongTo(Groupe::class);
    }
}
