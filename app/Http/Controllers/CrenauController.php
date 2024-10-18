<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Crenau;
use Carbon\Carbon;
use App\Models\Jour;

class CrenauController extends Controller
{
    public function affecter(Request $request)
    {
        // Validation de la requête
        $request->validate([
            'datedebut' => 'required|date',
            'datefin' => 'required|date|after_or_equal:datedebut',
        ]);

        // Utilisation de Carbon pour parser les dates
        $debut = Carbon::parse($request->datedebut);
        $fin = Carbon::parse($request->datefin);

        // Liste des créneaux à créer
        $creneauxTypes = ['08h-10h', '10h-12h', '12h-14h', '14h-16h'];

        while ($debut->lte($fin)) {
            // Création ou récupération du jour
            $jour = Jour::firstOrCreate(['jour' => $debut->toDateString()]);

            // Pour chaque type de créneau, créer un créneau pour ce jour
            foreach ($creneauxTypes as $type) {
                Crenau::firstOrCreate([
                    'jour_id' => $jour->id,
                    'crenaux' => $type
                ]);
            }

            // Passer au jour suivant
            $debut->addDay();
        }


        return redirect('periode')->with('success', 'Créneaux assignés avec succès pour la période donnée!');

    }
}
