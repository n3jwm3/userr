@extends('layouts.app')
@section('content')

    <title>Gestion Planning</title>
    <link rel="stylesheet" href="/CSS/GestionPlanning.css">

    <div style="margin-bottom: 100px">
        <h2 id="texte1" style="text-align: center">Veuillez sélectionner les informations relatives à votre période d'examen</h2>
    </div>
    <div class="container" id="container" style="margin-top: 50px">
        <div style="margin-bottom: 80px; text-align: center;">
            <img id="logo" src="{{ asset('Images/fond_de_site-removebg-preview.png') }}" alt="Logo">
        </div>
        <form action="/traitement/cre" method="post">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="datedebut" class="form-label">Date debut</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" id="datedebut" name="datedebut" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="datefin" class="form-label">Date Fin</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" id="datefin" name="datefin" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" id="nextPageButton" class="btn-modifier" style="margin-top: 30px">Valider la periode</button>
        </form>
    </div>

    <style>
        .btn-modifier {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            background-color: #35512f;
            color: #fff;
            border: none;
            padding: 10px;
            margin-left: 0;
        }

    </style>
@endsection
