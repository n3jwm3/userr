<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Examen;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportDataToExcel;
use PDF;
use Illuminate\Support\Facades\DB;

class DashbaordController extends Controller
{
public function dashbaord()
{
$data['header_title'] = 'Acceuil';

$examens = Examen::with(['module.specialite', 'local', 'crenau', 'users'])->get();
$data['examens'] = $examens;

if (Auth::user()->user_type == 1) {
return view('admin.dashbaord', $data);
} elseif (Auth::user()->user_type == 2) {
return view('teacher.dashbaord', $data);
}
}

public function exportPdf(Request $request)
{
$specialite = $request->input('specialite');

if (!empty($specialite)) {
$examens = Examen::whereHas('module.specialite', function ($query) use ($specialite) {
$query->where('nom', $specialite);
})
->with(['module', 'local', 'crenau.jour', 'users'])
->get();

$data = (new ExportDataToExcel($examens))->extractExamData($examens);

$pdf = PDF::loadView('planning.pdf', ['data' => $data]);
return $pdf->download('planning_' . str_replace(' ', '_', $specialite) . '.pdf');
} else {
return redirect()->back()->with('error', 'Spécialité non spécifiée.');
}
}

public function exportExcel(Request $request)
{
$specialite = $request->input('specialite');

if (!empty($specialite)) {
$examens = Examen::whereHas('module.specialite', function ($query) use ($specialite) {
$query->where('nom', $specialite);
})
->with(['module', 'local', 'crenau', 'crenau.jour', 'users'])
->get();

$excelFileName = 'planning_' . str_replace(' ', '_', $specialite) . '.xlsx';
return Excel::download(new ExportDataToExcel($examens), $excelFileName);
} else {
return redirect()->back()->with('error', 'Spécialité non spécifiée.');
}
}

public function supprimerplanning(Request $request)
{
$specialite = $request->input('specialite');

if (empty($specialite)) {
return redirect()->route('plsab')->with('error', 'Spécialité non spécifiée.');
}

try {
DB::statement('SET FOREIGN_KEY_CHECKS=0');

Examen::whereHas('module.specialite', function ($query) use ($specialite) {
$query->where('nom', $specialite);
})->delete();

DB::statement('SET FOREIGN_KEY_CHECKS=1');

return redirect()->route('plsab')->with('success', 'Le planning de la spécialité a été supprimé avec succès.');
} catch (\Exception $e) {
DB::statement('SET FOREIGN_KEY_CHECKS=1');

return redirect()->route('plsab')->with('error', 'Une erreur est survenue lors de la suppression du planning : ' . $e->getMessage());
}
}
}
