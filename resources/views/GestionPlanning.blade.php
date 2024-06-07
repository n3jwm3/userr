@extends('layouts.app')
@section('title', 'Horaires')
@section('content')

    <title>Gestion Planning</title>
    <link rel="stylesheet" href="/CSS/GestionPlanning.css">
    <style>
        /* Styles spécifiques pour les champs de saisie et les sélecteurs */
        #in, #to2, #numbor {
            display: flex;
            margin-top: 5px;
            flex-direction: column;
            align-items: flex-start;
            width: 90%;
        }

        #to, #to2, #numbor {
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            width: 100%; /* Ajustement de la largeur */
        }
        #todt{
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            width: 60%; /* Ajustement de la largeur */
        }



        /* Nouveau style pour le select de durée */
        #duréeRow select {
            margin-bottom: 5px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #ffffff;
            width: 100%; /* Ajustement de la largeur */
        }
        #nextPageButton {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f; /* Même couleur de fond que dans le deuxième code */
            color: white;
            cursor: pointer;
        }
    </style>

    <div style="margin-bottom: 100px">
        <h3 id="texte1" style="text-align: center">Veuillez sélectionner les informations relatives à votre emploi du temps</h3>
    </div>
    <div class="container" id="container" style="margin-top: 50px">
        <div style="margin-bottom: 80px">
            <img id="logo" src="{{ asset('Images/fond_de_site-removebg-preview.png') }}" alt="Logo">
        </div>
        <form action="/traitement/cre" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6"> <!-- Colonne 1 -->
                    <h4>Session </h4>
                    <select id="to" name="session">
                        <option value="1">Normale</option>
                        <option value="2">Remplacement</option>
                        <option value="3">Rattrapage</option>
                    </select>
                    <h4>Spécialité </h4>
                    <select id="to" name="formation">
                        @foreach ($spec as $s)
                            <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                        @endforeach
                    </select>
                    <h4>Semestre</h4>
                    <select id="to" name="semestre">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
                <div class="col-md-6"> <!-- Colonne 2 -->
                    <div class="row">
                        <h4 style="margin-right: 50px;">Date début</h4>
                        <input type="date" id="todt" name="datedebut">
                    </div>
                    <div class="row">
                        <h4 style="margin-right: 50px;">Date Fin</h4>
                        <input type="date" id="todt" name="datefin">
                    </div>
                    <div class="row" id="duréeRow"> <!-- Nouvelle row pour la durée -->
                        <h4 style="margin-right: 150px;">Durée                       </h4>
                        <select name="duree">
                            <option value="1">1h</option>
                            <option value="1.5">1h30min</option>
                            <option value="2">2h</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" id="nextPageButton" style="text-decoration-color: white">Génerer le planning </button>
        </form>
        <a href="GestionHoraire">Aller à la page de génération</a>
    </div>
@endsection
