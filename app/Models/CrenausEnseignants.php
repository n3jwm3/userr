<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrenausEnseignants extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'crenau_id', 'user_id',
    ];

    public function crenau()
    {
        return $this->belongsTo(Crenau::class, 'crenau_id');
    }
}
