<?php

namespace App\Http\Controllers;

use App\Services\ExamScheduler;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    protected $scheduler;

    // Injection de dépendance du service ExamScheduler
    public function __construct(ExamScheduler $scheduler)
    {
        $this->scheduler = $scheduler;
    }

    // Méthode pour créer le planning via une requête HTTP POST
    public function create(Request $request)
    {
        $startDate = $request->input('start_date'); // Récupérer la date de début à partir de la requête
        $endDate = $request->input('end_date'); // Récupérer la date de fin à partir de la requête
        $schedule = $this->scheduler->generateSchedule($startDate, $endDate); // Générer le planning
        return response()->json($schedule); // Retourner le planning en format JSON
    }

    // ma propre fonction :
    public function generer()
    {
        
    }
}
