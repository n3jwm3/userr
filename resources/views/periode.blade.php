@extends('layouts.app')
@section('content')

<title>Gestion Planning</title>
<link rel="stylesheet" href="/CSS/GestionPlanning.css">


<div style="margin-bottom: 100px">
    <h2 id="texte1" style="text-align: center">Veuillez sélectionner les informations relatives à votre période d'examen</h2>
</div>
<div class="container" id="container" style="margin-top: 50px" >
    <div style="margin-bottom: 80px">
        <img id="logo" src="{{ asset('Images/fond_de_site-removebg-preview.png') }}" alt="Logo" >
    </div>
    <form action="/traitement/cre" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6" >
                <div class="row">
                    <h3>Date debut</h3>
                    <input type="date" name="datedebut">
                </div>
            </div>
            <div class="col-sm-12 col-md-6" >
                <div class="row">
                    <h3>Date Fin</h3>
                    <input type="date" name="datefin">
                </div>
            </div>
        </div>
        <button type="submit" id="nextPageButton" style="margin-top: 30px">Valider la periode</button>
    </form>

    
</div>
@endsection



