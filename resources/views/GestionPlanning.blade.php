@extends('layouts.app')
@section('content')

<title>Gestion Planning</title>
<link rel="stylesheet" href="/CSS/GestionPlanning.css">


<div style="margin-bottom: 100px">
    <h2 id="texte1" style="text-align: center">Veuillez sélectionner les informations relatives à votre emploi du temps</h2>
</div>
<div class="container" id="container" style="margin-top: 50px" >
    <div style="margin-bottom: 80px">
        <img id="logo" src="{{ asset('Images/fond_de_site-removebg-preview.png') }}" alt="Logo" >
    </div>
    <form action="/generer/traitement" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6" >
                <h3>Session :</h3>
                <select id="session" name="sessionn">
                    <option value="Normale">Normale</option>
                    <option value="Remplacement">Remplacement</option>
                    <option value="Rattrapage">Rattrapage</option>
                </select>
                <br>
                <h3>Spécialité/filière</h3>
                <select id="formation" name="formationn">
                    @foreach ($spec as $s)
                    <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                    @endforeach
                </select>
                <br>
                <h3>Semestre</h3>
                <select name="semestre" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
            
        </div>
        <button type="submit" id="nextPageButton" onclick="window.location.href=''" style="margin-top: 30px">Génerer un planning </button>
    </form>
    <a href="planning">Voir planning</a>
    
</div>
@endsection



