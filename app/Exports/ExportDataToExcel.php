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
        return $this->extractExamData($this->examens);
    }

    public function headings(): array
    {
        return [
            'Dates et créneaux',
            'Module',
            'Local',
            'Groupes',
            'Enseignants',
        ];
    }

    public function extractExamData($examens)
    {
        $groupedExamens = $examens->groupBy('module.libelle');
        $data = [];

        foreach ($groupedExamens as $module => $exams) {
            $datesCreneaux = collect();
            $allEnseignants = collect();
            $local = '';
            $groupes = '';

            foreach ($exams as $exam) {
                $datesCreneaux->push($exam->crenau->jour->jour . ' ' . $exam->crenau->crenaux);
                $allEnseignants = $allEnseignants->merge($exam->users->pluck('name'));

                if (!$local) {
                    $local = $exam->local->libelle . ' (' . $exam->local->type . ')';
                    $groupes = $exam->local->groupes
                        ? $exam->local->groupes->map(function ($groupe) {
                            return $groupe->nom . ' (' . $groupe->section->nom . ')';
                        })->join(', ')
                        : 'Aucun groupe affecté';
                }
            }

            $datesCreneauxStr = $datesCreneaux->unique()->implode(', ');
            $enseignants = $allEnseignants->unique()->join(', ');

            $data[] = [
                'dates_creneaux' => $datesCreneauxStr,
                'module' => $module,
                'local' => $local,
                'groupes' => $groupes,
                'enseignants' => $enseignants,
            ];
        }

        return collect($data);
    }
}
