<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportDataToExcel implements FromCollection, WithHeadings
{
    protected $examens;

    public function __construct($examens)
    {
        $this->examens = $examens;
    }

    public function collection()
    {
        // Grouper les examens par module pour s'assurer que chaque module est listé une seule fois
        $groupedExamens = $this->examens->groupBy('module.libelle');

        // Préparer les données pour le fichier Excel
        $data = [];
        foreach ($groupedExamens as $module => $exams) {
            // On prend seulement le premier examen de chaque module
            $firstExam = $exams->first();

            // On récupère la date et le créneau de l'examen
            $dateCreneau = $firstExam->crenau->jour->jour . ' ' . $firstExam->crenau->crenaux;

            // On suppose que tous les examens pour un module ont les mêmes attributs (local, enseignants, etc.)
            $enseignants = $firstExam->enseignants->pluck('name')->join(', ');

            // Récupérer le libellé et le type du local
            $local = $firstExam->local->libelle . ' (' . $firstExam->local->type . ')';

            // Vérifier si le local a des groupes associés
            if ($firstExam->local->groupes) {
                // Récupérer les groupes affectés à ce local avec leurs sections
                $groupes = $firstExam->local->groupes->map(function ($groupe) {
                    return $groupe->nom . ' (' . $groupe->section->nom . ')';
                })->join(', ');
            } else {
                $groupes = 'Aucun groupe affecté';
            }

            $data[] = [
                'dates_creneaux' => $dateCreneau,
                'module' => $firstExam->module->libelle,
                'local' => $local,
                'groupes' => $groupes,
                'enseignants' => $enseignants,
            ];
        }

        return collect($data);
    }





    public function headings(): array
    {
        return [
            'Dates et créneaux',
            'Module',
            'Local',
            'Enseignants',
        ];
    }
}
