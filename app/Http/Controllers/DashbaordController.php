<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashbaordController extends Controller
{
    public function dashbaord()
    {
         $data['header_title'] =  'Acceuil';
        if(Auth::user()->user_type == 1)
        {
            return view('admin.dashbaord',$data);
        }
        elseif(Auth::user()->user_type == 2)
        {
            return view('teacher.dashbaord',$data);
        }
       
    }
}
