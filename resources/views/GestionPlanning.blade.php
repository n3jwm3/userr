@extends('layouts.app')
@section('title', 'Horaires')
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
    <form action="/traitement/cre" method="post">
        @csrf
        <div class="row">
            <div class="col-sm-12 col-md-6" >
                <h3>Session :</h3>
                <select id="session" name="session">
                    <option value="1">Normale</option>
                    <option value="2">Remplacement</option>
                    <option value="3">Rattrapage</option>
                </select>
                <br>
                <h3>Spécialité/filière</h3>
                <select id="formation" name="formation">
                    @foreach ($spec as $s)
                    <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                    @endforeach
                </select>
                <br>
                <h3>Semestre</h3>
                <select name="" id="">
                    <option value="">1</option>
                    <option value="">2</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-6" >
                <div class="row">
                    <h3>Date debut</h3>
                    <input type="date" name="datedebut">
                </div>
                <div class="row">
                    <h3>Date Fin</h3>
                    <input type="date" name="datefin">
                </div>
                <div class="row">
                    <h3>Duré</h3>
                    <select name="" id="">
                        <option value="">1h</option>
                        <option value="">1h30min</option>
                        <option value="">2h</option>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" id="nextPageButton" onclick="window.location.href=''" style="margin-top: 30px">Page suivante</button>
    </form>
    <a href="GestionHoraire">Vas pour page de generation</a>

</div>
@endsection



