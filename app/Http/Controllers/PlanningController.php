<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

use App\Models\Examen ;
use App\Models\Module ;
use App\Models\ExamensGroupes;
use App\Models\ExamensUsers;

class PlanningController extends Controller
{
    public function afficherplanning()
    {
        $examen = Examen::all();
        $modules = Module::all();
        return view('planning',compact('examen','modules'));
    }
    
    // la fonction pour suppression de contenue de la table enseignant : 
    // traiter la supression :
    public function supprimer_planning()
    {   
        // recuperer id des modules de la specialite :
        $module_ids = Module::where('specialite_id',$specialite)->pluck('id');

        // desactiver la contrainter des clé etrangaire pour réussir la supression 
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
      //  ExamensGroupes::truncate();
      //  ExamensUsers::truncate();
        Examen::whereIn('module_id',$module_ids)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        return redirect('GestionPlanning');
    }
}