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
    public function supprimer_planning(Request $request)
    {
        // Récupérer les identifiants des modules à supprimer
        $mod_ids = $request->input('ids');

        // Vérifier si les identifiants des modules sont fournis
        if (empty($mod_ids)) {
            // Stocker un message d'erreur dans la session
            return redirect('GestionPlanning')->with('error', 'Aucun identifiant de module fourni.');
        }

        try {
            // Désactiver la contrainte des clés étrangères pour réussir la suppression
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            // Supprimer les examens liés aux modules spécifiés
            Examen::whereIn('module_id', $mod_ids)->delete();

            // Réactiver la contrainte des clés étrangères
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Stocker un message de succès dans la session
            return redirect()->route('plsab')->with('success', 'Les examens ont été supprimés avec succès.');
        } catch (\Exception $e) {
            // Réactiver la contrainte des clés étrangères en cas d'exception
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // Stocker le message d'erreur dans la session
            return redirect('GestionPlanning')->with('error', 'Une erreur est survenue lors de la suppression des examens : ' . $e->getMessage());
        }
    }




    // la fonction pour valider un planning :

    public function valider_planning()
    {
        $spec = Specialite::all();
        $mod = Module::all();
        return redirect()->route('plsab')->with('success', 'Planning Ajouté avec succès');
    }

}
