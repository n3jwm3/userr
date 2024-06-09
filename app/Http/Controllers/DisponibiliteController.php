<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CrenausUsers;
use App\Models\Crenau;
use Illuminate\Support\Facades\Auth;

class DisponibiliteController extends Controller
{

    public function list()
    {
        $currentUser = Auth::user();
        $data['getRecord'] = CrenausUsers::with('crenau.jour') // Include related models
        ->where('user_id', $currentUser->id)
        ->orderBy('id', 'desc')
        ->get();
        $data['header_title'] = "Disponibilite";
        return view('teacher.disponibilite.DisponnabilitéEns',$data);
        //
    }


    public function add()
    {
      //  $crenaux = Crenau::all(); // Récupérer tous les créneaux disponibles
      $crenaux = Crenau::with('jour')->get(); // Récupérer tous les créneaux avec leurs jours associés
        $data['crenaux'] = $crenaux;
        $data['header_title'] = "Disponibilite";
        return view('teacher.disponibilite.create',$data);

    }
    public function insert(Request $request)
    {
       // $this->validate($request, [

          //  'crenaux' => ['required', 'array'], // Mettre 'crenaux' comme un tableau
           // 'crenaux.*' => ['in:8h-10h,10h-12h,12h-14h,14h-16h'], // Chaque élément de 'crenaux' doit être dans cette liste
       // ]);
        $save = new CrenausUsers;
       // $save->jour =  trim($request->jour);
        //$save['crenaux'] = implode(',', $request->crenaux);
        $save->crenau_id = $request->crenau_id;
        $save->user_id = Auth::user()->id;
        $save->save();
        return redirect('teacher/disponibilite/list')->with('success',"Disponibilte créé avec succès");

    }
    public function destroy(string $id)
    {
        $disponibilite = CrenausUsers::findOrFail($id);
        $disponibilite->delete();
        return redirect()->route('lo')->with([
            "success" => "supprimier avec succes"
        ]);
    }
}
