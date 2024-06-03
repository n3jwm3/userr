<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Examen ;
use App\Models\Module ;

class PlanningController extends Controller
{
    public function afficherplanning()
    {
        $examen = Examen::all();
        $modules = Module::all();
        return view('planning',compact('examen','modules'));
    }
}