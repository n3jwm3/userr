<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Examen;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDataToExcel;
use PDF;

class DashbaordController extends Controller
{
    public function dashbaord()
    {
        $data['header_title'] = 'Acceuil';

        $examens = Examen::with(['module.specialite', 'local', 'crenau', 'enseignants'])->get(); // Récupérer tous les examens sans pagination
        $data['examens'] = $examens;

        if (Auth::user()->user_type == 1) {
            return view('admin.dashbaord', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.dashbaord', $data);
        }
    }

    public function exportPdf()
    {
        $examens = Examen::with(['module', 'local', 'crenau.jour', 'enseignants'])->get();

        $pdfData = collect();
        $modulesAffiches = [];

        foreach ($examens as $examen) {
            $moduleId = $examen->module_id;
            $module = optional($examen->module)->libelle;

            if (!isset($modulesAffiches[$moduleId])) {
                $modulesAffiches[$moduleId] = true;

                $date = optional(optional($examen->crenau)->jour)->jour;
                $creneau = optional($examen->crenau)->crenaux;
                $local = optional($examen->local)->nom;
                $enseignants = $examens->where('module_id', $moduleId)->pluck('enseignants')->flatten()->pluck('name')->unique()->join(', ');

                $pdfDataRow = [
                    'module' => $module,
                    'local' => $local,
                    'enseignants' => $enseignants,
                    'date' => $date,
                    'creneau' => $creneau,
                ];

                $pdfData->push($pdfDataRow);
            }
        }

        $pdf = PDF::loadView('planning.pdf', ['pdfData' => $pdfData]);
        return $pdf->download('planning.pdf');
    }









    public function exportExcel(Request $request)
    {
        $specialite = $request->input('specialite');

        if (!empty($specialite)) {
            $examens = Examen::whereHas('module.specialite', function ($query) use ($specialite) {
                $query->where('nom', $specialite);
            })
                ->with(['module', 'local', 'crenau', 'crenau.jour', 'enseignants'])
                ->get();

            $excelFileName = 'planning_' . str_replace(' ', '_', $specialite) . '.xlsx';
            return Excel::download(new ExportDataToExcel($examens), $excelFileName);
        } else {
            return redirect()->back()->with('error', 'Spécialité non spécifiée.');
        }
    }



}

