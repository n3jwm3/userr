<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Groupe;
use App\Models\Local;
use App\Models\Crenau;
use App\Models\Examen;
use App\Models\User;
use App\Models\Jour;  // Modèle User pour les enseignants
use Carbon\Carbon;

class GestionHorraireController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('GestionHoraire', compact('modules'));
    }

    public function genererPlanning()
    {
        $modules = Module::all();
        $groupes = Groupe::all();
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
        $enseignantSurveillances = [];

        foreach ($modules as $module) {
            $found = false;
            foreach ($crenaux as $crenau) {
                if (!isset($joursExamens[$crenau->jour_id]) && !isset($joursExamens[$crenau->jour_id - 1]) && !isset($joursExamens[$crenau->jour_id + 1])) {
                    $locauxDisponibles = $this->findAvailableLocals($crenau, $locaux, $module, $groupes, $localCapacities);

                    if (!empty($locauxDisponibles)) {
                        $this->planExamen($module, $crenau, $locauxDisponibles, $groupes, $localCapacities, $localEnseignants, $enseignantSurveillances);

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
    }

    private function findAvailableLocals($crenau, $locaux, $module, $groupes, &$localCapacities)
    {
        $occupiedLocals = \DB::table('crenaus_locals')->where('crenau_id', $crenau->id)->pluck('local_id')->toArray();
        $selectedLocals = [];

        foreach ($locaux as $local) {
            if ($localCapacities[$local->id] > 0 && !in_array($local->id, $occupiedLocals)) {
                $selectedLocals[] = $local;
            }
        }

        return $selectedLocals;
    }

    private function planExamen($module, $crenau, $locauxDisponibles, $groupes, &$localCapacities, &$localEnseignants, &$enseignantSurveillances)
    {
        $responsablesModule = User::whereHas('modules', function ($query) use ($module) {
            $query->where('module_id', $module->id);
        })->get();

        $enseignants = User::all();

        while (true) {
            $responsableDisponible = $responsablesModule->first(function ($responsable) use ($crenau) {
                return !\DB::table('crenaus_enseignants')
                    ->where('user_id', $responsable->id)
                    ->where('crenau_id', $crenau->id)
                    ->exists();
            });

            if ($responsableDisponible) {
                $responsableAssigned = false;

                foreach ($groupes as $groupe) {
                    foreach ($locauxDisponibles as $local) {
                        if ($localCapacities[$local->id] >= $groupe->nombre_etudiant) {
                            $examen = new Examen([
                                'module_id' => $module->id,
                                'local_id' => $local->id,
                                'crenau_id' => $crenau->id,
                                'session' => '2024',
                                'duree' => '2 heures'
                            ]);
                            $examen->save();

                            if (!$responsableAssigned) {
                                $responsableId = $responsableDisponible->id;
                                $responsableAssigned = true;
                            } else {
                                $responsableId = $enseignants->filter(function ($enseignant) use ($crenau) {
                                    return !\DB::table('crenaus_users')
                                        ->where('user_id', $enseignant->id)
                                        ->where('crenau_id', $crenau->id)
                                        ->exists();
                                })->sortByDesc(function ($enseignant) use ($enseignantSurveillances) {
                                    return $enseignantSurveillances[$enseignant->id] ?? 0;
                                })->last()->id;
                            }

                            if (!isset($enseignantSurveillances[$responsableId])) {
                                $enseignantSurveillances[$responsableId] = 0;
                            }
                            $enseignantSurveillances[$responsableId]++;

                            $examen->enseignants()->attach($responsableId);
                            $examen->groupes()->attach($groupe);
                            $localCapacities[$local->id] -= $groupe->nombre_etudiant;
                            break;
                        }
                    }
                }
                break;
            } else {
                $nextCrenau = Crenau::where('id', '>', $crenau->id)->orderBy('id')->first();
                if (!$nextCrenau) {
                    $nextJour = Jour::where('id', '>', $crenau->jour_id)->orderBy('id')->first();
                    if ($nextJour) {
                        $nextCrenau = Crenau::where('jour_id', $nextJour->id)->orderBy('id')->first();
                    } else {
                        echo "Aucun créneau disponible pour le module " . $module->id . "\n";
                        return;
                    }
                }
                $crenau = $nextCrenau;
            }
        }
    }
}
