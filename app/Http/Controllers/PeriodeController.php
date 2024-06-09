<?php

namespace App\Http\Controllers;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Imports\LocalImport;
use Maatwebsite\Excel\Facades\Excel;

class PeriodeController extends Controller{
    // la fonction pour retourner la vue : 
    public function affperiode()
    {
        return view('periode');
    }
}