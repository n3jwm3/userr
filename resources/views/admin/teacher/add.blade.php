
@extends('layouts.app')
@section('content')
    <style>
        #ski {
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 93vh;
        }

        .card-body {
            width: 400px;
            padding: 20px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #aj {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f;
            color: #fff;
            cursor: pointer;
        }
        #essay{
            margin-left: 250px;
          width: calc(100% - 250px);
          background-color: #FEF5E7;
        }
    </style>

    <div class="container" id="essay">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row my-5">
                    <div class="col-md-6 mx-auto">
                        @include('alert')
                    </div>
                </div>
                <div>
                    <h6 class="text-center" id="mk">  <strong>Vous pouvez maintenant ajouter un enseignant en insérant ses coordonnées.</strong> </h6>
                </div>
                <div  id="ski">
                    <div class="card-body">
                        <div class="text-end" id="hov">
                                <a href="{{ url('admin/teacher/list')}}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                            </a>
                        </div>
                        <form method="POST" class="mt-3" action="{{ route('inser') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-5" id="in">
                                <input type="text" name="name" value="{{old("name")}}"  required placeholder="Nom" class="form-control" id="to">
                                <input type="text" name="prenom" value="{{old("prenom")}}" placeholder="Prenom" class="form-control" id="to2">
                            </div>
                            <div class="form-group mb-5">
                                <input type="text" class="form-control" value="{{old("grade")}}" placeholder="Grade" name="grade">
                                <select name="type" class="form-control" id="numbor" required>
                                    <option value="" selected disabled>Type</option>
                                    <option value="permanent">Permanent</option>
                                    <option value="vacataire">Vacataire</option>
                                    <option value="doctorant">Doctorant</option>
                                </select>
                            </div>


                            <div class="form-group mb-5" id="in4">
                                <input type="text" class="form-control" value="{{old("password")}}" placeholder="Mot de passe" name="password" id="jp">
                            </div>
                            <div class="form-group mb-5">
                                <input type="email" class="form-control" value="{{old("email")}}" required  placeholder="exemple@gmail.com" name="email" id="mee">
                                {{ $errors->first('email')}}
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2"> <!-- Utilisez la classe Bootstrap "offset-md-2" pour centrer -->
                                    <button type="submit" class="btn btn-dark" id="aj">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
@endsection


