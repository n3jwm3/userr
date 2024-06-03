@extends('layouts.app')

@section('title', 'Horaires')

@section('content')

<title>Gestion d'horaire</title>
<link rel="stylesheet" href="/CSS/GestionHoraire.css">


<div style="margin-bottom: 100px">
    <h2 id="texte1" style="text-align: center">Vous pouvez maintenant programmer votre emploi du temps avec les horaires souhaités</h2>
</div>
<div class="container" style="margin-top: 50px">
    <form action="/generer/traitement" method="post">
        @csrf
        <div style="margin-bottom: 80px">
            <img id="logo" src="{{ asset('Images/horaires-removebg-preview.png') }}" alt="Logo" >
        </div>
        <h2>ici pour générer un planning puis vérifier dans la base de donne : </h2>
        <button id="pagesuivante" type="submit" >Générer</button>
    </form>
    <a href="planning">Voir le planning</a>
</div>

@endsection



