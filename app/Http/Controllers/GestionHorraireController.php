<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Local;
use App\Models\Crenau;
use App\Models\Examen;
use App\Models\User;
use App\Models\Jour;
use App\Models\Section;
use App\Models\Specialite;
use APP\Models ;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GestionHorraireController extends Controller
{
    public function index()
    {
        return view('GestionHoraire');
    }
    
    public function genererPlanning(Request $request)
    {   
        // recuperer la session : 
        $session = $request->sessionn;
        // recuperer la specialite 
        $specialite = $request->formationn;
        
        // recuperer le semestre
        $semestre = $request->semestre ;
        
        // trouver les modules d'une spécialite d'un semestre
        $modules = Module::where('specialite_id', $specialite)->where('semestre', $semestre)->get();
        
        
        // trouver les groupes d'une spécialite : 
        // trouver les section d'une specialite :
        $section_ids = Section::where('specialite_id',$specialite)->pluck('id');
        $groupes = Groupe::whereIn('section_id',$section_ids)->get();
        
        
        $locaux = Local::all();
        $crenaux = Crenau::all()->sortBy('jour_id');
        
        $localCapacities = $locaux->mapWithKeys(function ($local) {
            return [$local->id => $local->capacite];
        });
        
        // Sauvegarde des capacités initiales pour réinitialisation
        $initialCapacities = $localCapacities->toArray();
        
        // Nouveau: stockage des enseignants par local
        $localEnseignants = [];
        
        $joursExamens = [];
        
        foreach ($modules as $module) {
            $found = false;
            foreach ($crenaux as $crenau) {
                if (!isset($joursExamens[$crenau->jour_id]) && !isset($joursExamens[$crenau->jour_id - 1]) && !isset($joursExamens[$crenau->jour_id + 1])) {
                    $locauxDisponibles = $this->findAvailableLocals($crenau, $locaux, $module, $groupes, $localCapacities);
                    
                    if (!empty($locauxDisponibles)) {
                        $this->planExamen($module, $crenau, $locauxDisponibles, $groupes, $localCapacities, $localEnseignants, $enseignantSurveillances,$session);
                        
                        // Réinitialisation des capacités des locaux à leur valeur initiale
                        $localCapacities = collect($initialCapacities);
                        
                        $joursExamens[$crenau->jour_id] = true;
                        $found = true;
                        break;
                    }
                }
            }
            if (!$found) {
                echo "Aucun créneau disponible pour le module " . $module->id . "\n";
            }
        }
        $examen = Examen::all();
        $modules = Module::all();
        return view('planning',compact('examen','modules','specialite'));
    }
    
    
    private function findAvailableLocals($crenau, $locaux, $module, $groupes, &$localCapacities)
    {
<<<<<<< HEAD
        // Récupérer tous les enregistrements de la table crenaus_locals pour le créneau donné
        $occupiedLocals = \DB::table('crenaus_locals')->where('crenau_id', $crenau->id)->pluck('local_id')->toArray();
        
        // Calculer le nombre total d'étudiants dans tous les groupes
        $totalNbEtud = array_sum($groupes->pluck('nombre_etudiant')->toArray());
        $selectedLocals = []; // Liste des locaux sélectionnés
        
        // Boucle à travers chaque local pour vérifier s'il est disponible et a suffisamment de capacité
=======
        $occupiedLocals = DB::table('crenaus_locals')->where('crenau_id', $crenau->id)->pluck('local_id')->toArray();
        $selectedLocals = [];

>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b
        foreach ($locaux as $local) {
            if ($localCapacities[$local->id] > 0 && !in_array($local->id, $occupiedLocals)) {
                $selectedLocals[] = $local; // Ajouter le local à la liste des locaux disponibles
            }
        }
        
        return $selectedLocals; // Retourner les locaux disponibles
    }
    
    
    private function planExamen($module, $crenau, $locauxDisponibles, $groupes, &$localCapacities, &$localEnseignants, &$enseignantSurveillances,$session)
    {
        // Récupération des enseignants responsables du module
        $responsablesModule = User::whereHas('modules', function ($query) use ($module) {
            $query->where('module_id', $module->id);
        })->get();
        
        // Récupération de tous les enseignants
        $enseignants = User::all();
        
        // Boucle pour vérifier la disponibilité des créneaux jusqu'à trouver un créneau où un responsable est disponible
        while (true) {
            // Vérifier la disponibilité des enseignants responsables pour le créneau donné
            $responsableDisponible = $responsablesModule->first(function ($responsable) use ($crenau) {
<<<<<<< HEAD
                return !\DB::table('crenaus_users')
                ->where('user_id', $responsable->id)
                ->where('crenau_id', $crenau->id)
                ->exists();
=======
                return !DB::table('crenaus_enseignants')
                    ->where('user_id', $responsable->id)
                    ->where('crenau_id', $crenau->id)
                    ->exists();
>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b
            });
            
            // Si un responsable est disponible, procéder à la planification
            if ($responsableDisponible) {
                $responsableAssigned = false;
                
                // Boucle à travers chaque groupe
                foreach ($groupes as $groupe) {
                    // Boucle à travers chaque local disponible
                    foreach ($locauxDisponibles as $local) {
                        // Vérifier si le local peut accueillir le groupe d'étudiants
                        if ($localCapacities[$local->id] >= $groupe->nombre_etudiant) {
                            // Création d'une nouvelle instance de l'examen
                            $examen = new Examen([
                                'module_id' => $module->id,
                                'local_id' => $local->id,
                                'crenau_id' => $crenau->id,
                                'session' => $session,
                                'duree' => '2 heures'
                            ]);
                            $examen->save();
                            
                            // Choisir un enseignant responsable du module si aucun n'a été assigné
                            if (!$responsableAssigned) {
                                $responsableId = $responsableDisponible->id;
                                $responsableAssigned = true;
                            } else {
                                // Choisir l'enseignant avec le moins de surveillances parmi ceux disponibles
                                $responsableId = $enseignants->filter(function ($enseignant) use ($crenau) {
<<<<<<< HEAD
                                    return !\DB::table('crenaus_users')
                                    ->where('user_id', $enseignant->id)
                                    ->where('crenau_id', $crenau->id)
                                    ->exists();
=======
                                    return !DB::table('crenaus_enseignants')
                                        ->where('user_id', $enseignant->id)
                                        ->where('crenau_id', $crenau->id)
                                        ->exists();
>>>>>>> 538687531b3f49132f3ed7eba8902d6cf1c8b57b
                                })->sortByDesc(function ($enseignant) use ($enseignantSurveillances) {
                                    return $enseignantSurveillances[$enseignant->id] ?? 0;
                                })->last()->id;
                            }
                            
                            // Incrémenter le compteur de surveillances pour cet enseignant
                            if (!isset($enseignantSurveillances[$responsableId])) {
                                $enseignantSurveillances[$responsableId] = 0;
                            }
                            $enseignantSurveillances[$responsableId]++;
                            
                            // Attacher l'enseignant choisi à l'examen
                            $examen->users()->attach($responsableId);
                            
                            // Attacher le groupe à l'examen
                            $examen->groupes()->attach($groupe);
                            
                            // Réduire la capacité du local du nombre d'étudiants dans le groupe
                            $localCapacities[$local->id] -= $groupe->nombre_etudiant;
                            break; // Sortir de la boucle des locaux une fois que le groupe est placé
                        }
                    }
                }
                break; // Sortir de la boucle principale une fois que l'examen est planifié
            } else {
                // Si aucun responsable n'est disponible pour le créneau actuel, trouver un autre créneau
                $nextCrenau = Crenau::where('id', '>', $crenau->id)->orderBy('id')->first();
                if (!$nextCrenau) {
                    // Si aucun autre créneau n'est disponible, passer à un autre jour
                    $nextJour = Jour::where('id', '>', $crenau->jour_id)->orderBy('id')->first();
                    if ($nextJour) {
                        $nextCrenau = Crenau::where('jour_id', $nextJour->id)->orderBy('id')->first();
                    } else {
                        echo "Aucun créneau disponible pour le module " . $module->id . "\n";
                        return; // Sortir si aucun créneau n'est disponible pour le module
                    }
                }
                $crenau = $nextCrenau;
            }
        }
    }
    
    
    
}