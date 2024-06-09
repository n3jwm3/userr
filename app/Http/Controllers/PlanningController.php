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
use App\Models\Specialite;

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

        $sp = $specialite ;
        // recuperer les module de la specialite :
        $module_ids  = Module::where('specialite_id',$sp)->pluck('id');

        // desactiver la contrainter des clé etrangaire pour réussir la supression
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        //  ExamensGroupes::truncate();
        //  ExamensUsers::truncate();
        // Examen::truncate();
        Examen::where('module_id',$module_ids)->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect('GestionPlanning');
    }

    // la fonction pour valider un planning :
    public function valider_planning()
    {
        $spec = Specialite::all();
        $mod = Module::all();
        return view('GestionPlanning',compact('spec','mod'))->with('success', 'Ajouté avec succès');

    }
}
