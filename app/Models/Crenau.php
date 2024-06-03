<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crenau extends Model
{
    use HasFactory;
    protected $fillable = [
        'crenaux',
        'jour_id'
    ];

    public function jour()
    {
        //return $this->belongsTo(Jour::class);
        return $this->belongsTo(Jour::class, 'jour_id');
    }

    public function examens()
    {
        return $this->hasMany(Examen::class);
    }
}
