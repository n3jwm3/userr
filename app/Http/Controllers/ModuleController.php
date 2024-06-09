<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Specialite;
use App\Models\User;
use App\Models\UsersModules;



class ModuleController extends Controller
{
    public function listemodule()
    {
        $spec = Specialite::all();
        $mod = Module::all();
        $ens = User::all();
        return view('Modules.module',compact('mod','spec','ens'));
    }

    // la focntion pour ajouter un module:
    public function ajouter_module(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'semestre' =>['required' ,'in:1,2'],
            'specialite_id' => 'required',
        ]);
        // recuperer les donne :

        // pour inserer :
        $module = new Module();
        $module->libelle = $request->libelle;
        $module->semestre = $request->semestre;
        $module->specialite_id = $request->specialite_id;
        $module->save();

        $user_id = $request->input('user_id');
        $module_id = $module->id;
        if (!is_null($user_id)) {
            foreach ($user_id as $id) {


                $emm = new UsersModules();
                $emm->user_id = $id;
                $emm->module_id = $module_id;
                $emm->save();
            }
        }

        return redirect('Modules/module')->with('success','Ajouter avec succes');

    }
    // la fonction pour la supression d'un module :
    public function supprimer_mod($id)
    {
        // pour commencer dans la supression dans la table association puis le module :
        UsersModules::whereIn('module_id', [$id])->delete();
        $mod = Module::find($id);
        $mod->delete();
        return redirect('Modules/module');
    }

    // traiter la modification d'un module :

    // la fonction pour afficher la vue de la modification :
    // la fonction pour afficher la vue de la modification :
    // la fonction pour afficher la vue de la modification :
    public function update_mod($id)
    {
        $sp = Specialite::all(); // Récupérer les spécialités
        $mo = Module::find($id);
        $enseignants_module = $mo->users->pluck('id')->toArray(); // Récupérer les enseignants associés à ce module
        $ens = User::all(); // Renommer la variable pour éviter tout conflit
        return view('Modules.modifiermodule', compact('mo', 'sp', 'ens', 'enseignants_module'));
    }



    // traitement de modification
    public function modifier_module(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'semestre' =>['required' ,'in:1,2'],
            'specialite_id' => 'required',
        ]);

        // Récupérer le module à modifier
        $mod = Module::find($request->id);

        // Mettre à jour les données du module
        $mod->libelle = $request->libelle;
        $mod->semestre = $request->semestre;
        $mod->specialite_id = $request->specialite_id;
        $mod->save();

        // Mettre à jour les chargés de module associés
        $user_ids = $request->input('user_id', []);

        // Par défaut, tableau vide si aucun enseignant sélectionné
        $mod->users()->sync($user_ids); // Met à jour les enseignants associés au module

        return redirect('/Modules/module')->with('success', 'Modification avec succès');
    }



    // la fonction pour la recherche :
    public function search(Request $request)
    {
        $search = $request->search ;

        $mod = Module::where(function($query) use ($search){
            $query->where('libelle','like',"%$search%");
        })
            ->get();

        return view('Modules.module',compact('mod','search'));
    }
}
