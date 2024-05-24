<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Disponibilite;
use Illuminate\Support\Facades\Auth;

class DisponibiliteController extends Controller
{

    public function list()
    {
        $currentUser = Auth::user();
        $data['getRecord'] = Disponibilite::where('enseignant_id', $currentUser->id)
        ->orderBy('id', 'desc')->get();
        $data['header_title'] = "Disponibilite";
        return view('teacher.disponibilite.DisponnabilitéEns',$data);
        //
    }


    public function add()
    {
        $data['header_title'] = "Disponibilite";
        return view('teacher.disponibilite.create',$data);

    }
    public function insert(Request $request)
    {
        $this->validate($request, [

            'crenaux' => ['required', 'array'], // Mettre 'crenaux' comme un tableau
            'crenaux.*' => ['in:8h-10h,10h-12h,12h-14h,14h-16h'], // Chaque élément de 'crenaux' doit être dans cette liste
        ]);
        $save = new Disponibilite;
        $save->jour =  trim($request->jour);
        $save['crenaux'] = implode(',', $request->crenaux);

        $save->enseignant_id = Auth::user()->id;
        $save->save();
        return redirect('teacher/disponibilite/list')->with('success',"Disponibilte créé avec succès");

    }
    public function destroy(string $id)
    {
        $disponibilite = Disponibilite::findOrFail($id);
        $disponibilite->delete();
        return redirect()->route('lo')->with([
            "success" => "supprimier avec succes"
        ]);
    }
}
