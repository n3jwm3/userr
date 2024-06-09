<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UserImport;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = "Liste des enseignants";
        return view('admin.teacher.list',$data);
    }
    public function add()
    {

        $data['getClass'] = Classe::getClass();
        $data['header_title'] = "Ajouter un nouvel enseignant";
        return view('admin.teacher.add',$data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users'
        ]);
        $enseignant = new User;
        $enseignant->name = trim($request->name);
        $enseignant->prenom = trim($request->prenom);
        $enseignant->email = trim ($request->email);
        $enseignant->password = Hash::make($request->password);
        $enseignant->grade = trim($request->grade);
        $enseignant->type = trim($request->type);
        $enseignant->user_type = 2;
        $enseignant->save();
        return redirect('admin/teacher/list')->with('success',"L’enseignant créé avec succès");
    }


       public function delete(string $id){
        $user= User::where("id", $id)->first();
        $user->delete();
       // $user->save();
        return redirect('admin/teacher/list')->with('success',"L’enseignant supprimé avec succès");

    }
    public function edit(string $id)
    {
        //
        $enseignant= User::where('id', $id)->first();
        return view("admin.teacher.edit")->with([
            "enseignant" =>  $enseignant
        ]);
    }
    public function update(Request $request, string $id)
    {

        $enseignant=  User::where('id', $id)->first();
        $this->validate($request, [
            'name' =>'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' =>'required',
            'grade' => 'nullable',
            'type' =>['required' ,'in:vacataire,permanent,doctorant'],

        ]);

        $enseignant->name = trim($request->name);
        $enseignant->prenom = trim($request->prenom);
        $enseignant->email = trim($request->email);
        if(!empty($request->password)){
            $enseignant->password = Hash::make($request->password);
        }
        $enseignant->grade = trim($request->grade);
        $enseignant->type = trim($request->type);

        $enseignant->user_type = 2;
        $enseignant->save();
        return redirect()->route('listte')->with([
            "success" => "Modification avec succes"
        ]);
    }

    public function show(string $id)
    {
        //
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('listte')->with('error', 'Utilisateur non trouvé');
        }
        return view("admin.teacher.show")->with([
            'user' =>$user
             ]);
    }


    public function import_excel()
    {
        //
        return view('admin.teacher.list');
    }
    public function import_excel_post(Request $request)
       {
         // Validation du fichier
         $request->validate([
            'excel-file' => 'required|file|mimes:xlsx,xls,csv',
        ]);


           Excel::import(new UserImport,$request->file('excel-file'));
           return redirect()->route('listte')->with([
            "success" => "Importation avec succes"
        ]);

       }

}
