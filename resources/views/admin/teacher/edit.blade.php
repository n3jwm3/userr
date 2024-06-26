@extends('layouts.app')

@section('title', 'Enseignant')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <style>
        /* Styles CSS */
        #ski {
            border-radius: 15px;
            display: flex;
            height: 60vh;
            width: 700px; /* Largeur ajustée pour correspondre à la mise en forme */
            margin-right: 10px;
        }

        .card-body {
            /* Reproduction des styles de #ski */
            border-radius: 15px;
            display: flex;
            flex-direction: column; /* Afficher les éléments en colonne */
            justify-content: center;
            background-color: #ffffff;
            margin-top: 5px; /* Ajout de marge en haut pour éviter la superposition */
        }

        .form-group {
            margin-bottom: 5px;
            display: flex; /* Afficher les éléments de la forme horizontale */
        }

        .form-control {
            width: 120%; /* Augmentation de la largeur */
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            font-size: 14px; /* Réduire la taille de la police */
        }

        label {
            width: 100px; /* Ajuster la largeur des labels */
            margin-right: 10px; /* Ajouter de la marge à droite */
            text-align: right; /* Aligner le texte à droite */
            font-size: 14px; /* Réduire la taille de la police */
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
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row my-4">
                    <div class="col-md-6 mx-auto">
                        @include('alert')
                    </div>
                </div>
                <div id="ski">
                    <div class="card-body">
                        <div class="text-end" id="hov" style="margin-left: 400px;margin-bottom: 25px">
                            <a href="{{route('listte')}}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                            </a>
                        </div>
                        <form method="POST" class="mt-2" action="{{ route('updat',$enseignant->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3"> <!-- Nouvelle ligne Bootstrap -->
                                <div class="col-md-6"> <!-- Première colonne Bootstrap -->
                                    <div class="form-group">
                                        <label class="form-label fw-bold" for="name">Nom:</label>
                                        <input type="text" name="name" value="{{old("name",$enseignant->name)}}" required placeholder="Nom" class="form-control" id="bordno">
                                    </div>
                                </div>
                                <div class="col-md-6"> <!-- Deuxième colonne Bootstrap -->
                                    <div class="form-group">
                                        <label for="prenom" class="form-label fw-bold">Prénom:</label>
                                        <input type="text" name="prenom" value="{{old("prenom",$enseignant->prenom)}}" required placeholder="Prénom" class="form-control" id="bordpre">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3"> <!-- Nouvelle ligne Bootstrap -->
                                <div class="col-md-6"> <!-- Première colonne Bootstrap -->
                                    <div class="form-group">
                                        <label class="form-label fw-bold" for="type">Type:</label>
                                        <select name="type" class="form-control" id="bornum" required>
                                            <option value="" disabled>Type</option>
                                            <option {{ $enseignant->type === "permanent" ? "selected" : "" }} value="permanent">permanent</option>
                                            <option {{$enseignant->type === "vacataire" ? "selected" : "" }} value="vacataire">vacataire</option>
                                            <option {{$enseignant->type === "doctorant" ? "selected" : "" }} value="doctorant">doctorant</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"> <!-- Deuxième colonne Bootstrap -->
                                    <div class="form-group">
                                        <label class="form-label fw-bold" for="grade">Grade:</label>
                                        <input type="text" class="form-control" value="{{old("grade",$enseignant->grade)}}" required placeholder="Grade" name="grade" id="borgr">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3"> <!-- Nouvelle ligne Bootstrap -->
                                <div class="col-md-6"> <!-- Première colonne Bootstrap -->
                                    <div class="form-group">
                                        <label class="form-label fw-bold" for="password">Mot de passe:</label>
                                        <input type="text" class="form-control"  name="password" value="{{old("email",$enseignant->password)}}" required placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="col-md-6"> <!-- Deuxième colonne Bootstrap -->
                                    <div class="form-group d-flex align-items-center">
                                        <label class="form-label fw-bold" for="email">Email:</label>
                                        <input type="email" class="form-control" value="{{old("email",$enseignant->email)}}" required placeholder="Email" name="email" id="borem">
                                    </div>
                                    <div style="color: red">{{ $errors->first('email')}}</div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-dark" id="aj">
                                        {{ __('Modification') }}
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
