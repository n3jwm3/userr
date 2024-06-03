<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Models\Specialite;
use App\Models\Module;

class GestionplanningController extends Controller
{

    public function index()
    {
        $spec = Specialite::all();
        $mod = Module::all();
        return view('GestionPlanning',compact('spec','mod'));
    }

    
    
}