<?php

namespace App\Http\Controllers;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Imports\LocalImport;
use Maatwebsite\Excel\Facades\Excel;

class LocalController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        //
        $local = Local::all();
        return view('local.index')->with([
            'local' =>$local
        ]);
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        //
        return view('local.create');
    }
    
    /**
    * Store a newly created resource in storage.
    */
    use AuthorizesRequests, ValidatesRequests;
    public function store(Request $request)
    {
        //
        $this->validate ($request, [
            'libelle' =>'required',
            'capacite' => 'required',
            'type' =>['required' ,'in:Salle,Amphi'],
            
            
            
        ]);
        $data = $request->except(['_token']);
        local::create($data);
        return redirect()->route("local.index")->with([
            "success" => "Ajouter avec succes"
        ]);
    }
    
    public function edit(string $id)
    {
        //
        $local= Local::where('libelle', $id)->first();
        return view("local.edit")->with([
            "local" =>  $local
        ]);
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        //
        $local= Local::where('libelle', $id)->first();
        $this->validate($request, [
            'libelle' =>'required',
            'capacite' => 'required',
            'type' =>['required' ,'in:Salle,Amphi'],
            
            
        ]);
        $data = $request->except(['_token', '_method']);
        $local->update($data);
        return redirect()->route("local.index")->with([
            "success" => "Modification avec succes"
        ]);
    }
    
    /**
    * Remove the specified resource from storage.
    */
    
    public function destroy(string $id)
    {
        //
        $local= Local::where("id", $id)->first();
        $local->delete();
        return redirect()->route("local.index")->with([
            "success" => "Suppresion avec succes"
        ]);
    }
    public function import_excel_local()
    {
        //import_excel_local
        return view('local.index');
    }
    public function import_excel_local_post(Request $request)
    {
        $request->validate([
            'excel-file' => 'required|file|mimes:xlsx,xls,csv',
        ]);
        Excel::import(new LocalImport,$request->file('excel-file'));
        return redirect()->route("local.index")->with([
            "success" => "Importation avec succes"
        ]);
        
    }
}
