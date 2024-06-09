@extends('layouts.app')
@section('title', ' Local')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <style>
        #ski {
            border-radius: 25px;
            display: flex;
            justify-content: center; /* Centrer horizontalement */
            align-items: center; /* Centrer verticalement */
            height: 60vh; /* Réduction de la hauteur */
            margin-top: 5px; /* Réduction du margin-top */
        }

        /* Style des champs de formulaire */
        #in {
            display: flex;
            margin-top: 5px;
            flex-direction: column;
            align-items: flex-start;
        }

        #to, #to2, #numbor {
            margin-bottom: 5px;
            width: 100%;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc; /* Changement de la couleur de la bordure */
        }

        /* Changement de la couleur de fond des champs de formulaire */
        #to, #to2, #numbor, .form-control {
            background-color: #ffffff; /* Changement de la couleur de fond */
        }

        #aj {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f; /* Même couleur de fond que dans le deuxième code */

            cursor: pointer;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row my-5">
                    <div class="col-md-6 mx-auto">
                        @include('alert')
                    </div>
                </div>
                <div>
                    <h6 class="text-center" id="mk">  <strong>Ajouter un local en insérant ses coordonnées.</strong> </h6>
                </div>
                <div id="ski" style="background: white;">
                    <div class="card-body">
                        <div class="text-end" id="hov">
                            <a href="{{ route('local.index') }}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                            </a>
                        </div>
                        <form method="POST" class="mt-3" action="{{ route('local.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group mb-5" id="in">
                                <input type="text" name="libelle" value="{{ old('libelle') }}" placeholder="Le nom de l'amphi ou la salle" class="form-control" id="to" required>
                            </div>
                            <div class="form-group mb-5" id="in3">
                                <select name="type" class="form-control" id="numbor" required>
                                    <option value="" selected disabled>
                                        Type
                                    </option>
                                    <option value="Salle">Salle</option>
                                    <option value="Amphi">Amphi </option>
                                </select>
                            </div>
                            <div class="form-group mb-5">
                                <input type="number" name="capacite" maxlength="3" value="{{ old('capacite') }}" placeholder="Capacité" class="form-control" id="to2" required>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
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


