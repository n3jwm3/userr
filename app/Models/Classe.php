<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Classe extends Model
{
    use HasFactory;

    protected $table ='classes';
    /*static public function getRecord(){
        $return = Classe::select('classes.*','users.name as created_by_name')
        ->join('users', 'users.id', 'classes.created_by')
        ->orderBy('classes.id', 'desc')->get();
        return   $return;
    }*/
    static public function getClass(){
        $currentUser = Auth::user();
    
        $return = Classe::select('classes.*')
        ->join('users', 'users.id', 'classes.created_by')
        ->where('created_by', $currentUser->id)
        ->where('classes.status','=',0)
        ->orderBy('classes.id', 'asc')->get();
        return   $return;
    }

}
