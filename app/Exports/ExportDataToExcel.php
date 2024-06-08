<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Examen;

class ExportDataToExcel implements FromCollection, WithHeadings
{
    protected $examens;

    public function __construct($examens)
    {
        $this->examens = $examens;
    }

    public function collection()
    {
        return $this->examens->map(function($examen) {
            $enseignants = $examen->enseignants->pluck('name')->join(', ');
            return [
                'date_creneau' => $examen->crenau->date_creneau, // Assurez-vous d'avoir la colonne date_creneau dans la table crenauns
                'module' => $examen->module->nom,
                'local' => $examen->local->nom,
                'enseignants' => $enseignants,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Date et créneau',
            'Module',
            'Local',
            'Enseignants',
        ];
    }
}

