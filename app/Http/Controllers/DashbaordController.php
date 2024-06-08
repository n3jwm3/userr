<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Module;
use App\Models\Examen;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDataToExcel;
use PDF;

class DashbaordController extends Controller
{
    public function dashbaord()
    {
        $data['header_title'] = 'Acceuil';

        // Récupération des examens avec leurs modules et spécialités associés, avec pagination
        $examens = Examen::with(['module.specialite'])->paginate(10);

        $data['examens'] = $examens;

        if (Auth::user()->user_type == 1) {
            return view('admin.dashbaord', $data);
        } elseif (Auth::user()->user_type == 2) {
            return view('teacher.dashbaord', $data);
        }
    }

    public function exportPdf()
    {
        $examens = Examen::all();
        $pdf = PDF::loadView('planning.pdf', compact('examens'));
        return $pdf->download('planning.pdf');
    }

    public function exportExcel(Request $request)
    {
        $specialite = $request->input('specialite');

        if (!empty($specialite)) {
            $examens = Examen::whereHas('module.specialite', function ($query) use ($specialite) {
                $query->where('nom', $specialite);
            })->with(['module', 'local', 'enseignants'])->get();

            $excelFileName = 'planning_' . str_replace(' ', '_', $specialite) . '.xlsx';
            return Excel::download(new ExportDataToExcel($examens), $excelFileName);
        } else {
            return redirect()->back()->with('error', 'Spécialité non spécifiée.');
        }
    }
}
