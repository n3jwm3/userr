<?php

namespace App\Http\Controllers ;

use Illuminate\Http\Request ;
use App\Models\Specialite ;
use App\Models\Module;
use App\Models\EnseignantsModules;
use App\Models\Section;
use App\Models\Groupe;

class SpecialiteController extends Controller
{
    // la focntion pour afficher la liste de sspecialite :
    public function listespecialite()
    {
        // recuperer la liste des module :
       // $modules = Module::all();
        $specia = Specialite::all();
        $section = Section::all();
        $groupe = Section::all();
       // return view('specialites.specialite',compact('specia','modules','section','groupe'));
       return view('specialites.specialite',compact('specia','section','groupe'));
    }


    // la fonction pour ajouter une specialite
    public function ajouter_specialite(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'departement' => 'required',
            'niveau' => 'required',
            'nomsection.*' => 'required',  // Validation de chaque nom de section
            'nomgroupe.*.*' => 'required',  // Validation de chaque nom de groupe dans chaque section
            'nombre_etudiants.*.*' => 'required|integer|min:1',  // Validation du nombre d'étudiants pour chaque groupe
        ]);

        // Insertion de la spécialité
        $specialite = new Specialite();
        $specialite->nom = $request->nom;
        $specialite->departement = $request->departement;
        $specialite->niveau = $request->niveau;
        $specialite->save();

        // Traitement des sections
        foreach ($request->nomsection as $index => $nomSection) {
            $section = new Section();
            $section->nom = $nomSection;
            $section->specialite_id = $specialite->id;
            $section->save();

            // Traitement des groupes pour la section actuelle
            if (isset($request->nomgroupe[$index], $request->nombre_etudiants[$index])) {
                foreach ($request->nomgroupe[$index] as $i => $nomGroupe) {
                    $groupe = new Groupe();
                    $groupe->nom = $nomGroupe;
                    $groupe->nombre_etudiant = $request->nombre_etudiants[$index][$i]; // Ajout du nombre d'étudiants
                    $groupe->section_id = $section->id;
                    $groupe->save();
                }
            }
        }



        return redirect('admin/specialites/list')->with('success', 'Ajouté avec succès');
    }

    // traiter la supression :
    public function supprimer_specialite($id)
    {
        $specialite = Specialite::find($id);

        // recuperer les section de cette specaialite :
        $section_ids = Section::where('specialite_id',$id)->pluck('id');
        // supprimer dans la table groupe ou ya ces section :
        Groupe::whereIn('section_id',$section_ids)->delete();
        // supprimer dans la table section ou specialite_id = id :
        Section::whereIn('specialite_id',$specialite)->delete();


        // la bonne version de suppresion des modules ect :
        // recuperer les id des module de cette formation :
       // $module_ids = Module::where('specialite_id',$id)->pluck('id');
        // supprimer dans la table Enseignant_Module:
        //EnseignantsModules::whereIn('module_id',$module_ids)->delete();
        // supprimer les module lie a cette formation:
       // Module::where('specialite_id',$id)->delete();
        // supprimer la specialite de la table specialite:

        $specialite->delete();
        return redirect('admin/specialites/list')->with('success','Suppresion avec succes');
    }

    // traiter la modification :
    // la fonction pour modifier la formation :
    public function update_specialite($id)
    {
        $spec = Specialite::find($id);
        return view('specialites.modifier',compact('spec'));
    }

    // traiter la modification :

    public function update_specialite_traitement(Request $request)
    {

        $request->validate([
            'nom' => 'required',
            'departement' => 'required',
            'niveau' => 'required',
        ]);

        $speci = Specialite::find($request->id);

        $speci->nom = $request->nom;
        $speci->departement = $request->departement;
        $speci->niveau = $request->niveau;
        $speci->update();

        return redirect('admin/specialites/list')->with('success','Modification avec succes');
    }

}
