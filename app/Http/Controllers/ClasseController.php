<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Support\Facades\Auth;
class ClasseController extends Controller
{


    public function list()
    {
        $currentUser = Auth::user();
        $data['getRecord'] = Classe::where('created_by', $currentUser->id)
        ->orderBy('id', 'desc')->get();
       // $data['getRecord'] = Classe::getRecord();
        $data['header_title'] = "Class List";
        return view('admin.class.list',$data);
        //
    }
    public function add()
    {
        $data['header_title'] = "Class new  List";
        return view('admin.class.add',$data);

    }
    public function insert(Request $request)
    {

        $save = new Classe;
        $save->name = ($request->name);
        $save->status = ($request->status);
        $save->created_by = Auth::user()->id;
        $save->save();
        return redirect('admin/class/list')->with('success',"Class successfully created");

    }


    public function update(Request $request, string $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
