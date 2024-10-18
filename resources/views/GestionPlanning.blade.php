@extends('layouts.app')
@section('title', 'Horaires')
@section('content')

    <title>Gestion Planning</title>
    <link rel="stylesheet" href="/CSS/GestionPlanning.css">
    <style>
        /* Styles spécifiques pour les champs de saisie et les sélecteurs */
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .form-group label {
            flex: 0 0 150px; /* Ajuster la largeur des labels selon vos besoins */
            margin-bottom: 0;
            margin-right: 10px;
        }

        .form-group select,
        .form-group input {
            flex-grow: 1; /* Pour occuper tout l'espace restant de la ligne */
            border: 1px solid #ccc; /* Ajout de la bordure */
            padding: 8px; /* Ajout du padding pour l'espace intérieur */
            border-radius: 5px; /* Ajout du border-radius pour les coins arrondis */
            box-sizing: border-box; /* Pour inclure la bordure et le padding dans la largeur */
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

        /* Ajustement pour empêcher le défilement horizontal */
        body {
            overflow-x: hidden;
        }
    </style>

    <div style="margin-bottom: 50px">
        <h3 id="texte1" style="text-align: center">Veuillez sélectionner les informations relatives à votre emploi du temps</h3>
    </div>
    <div class="container">
        <form action="/generer/traitement" method="post">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="session">Session</label>
                        <select id="session" name="sessionn" class="form-control">
                            <option value="Normale">Normale</option>
                            <option value="Remplacement">Remplacement</option>
                            <option value="Rattrapage">Rattrapage</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formation">Spécialité</label>
                        <select id="formation" name="formationn" class="form-control">
                            @foreach ($spec as $s)
                                <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="semestre">Semestre</label>
                        <select name="semestre" id="semestre" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" id="nextPageButton" class="btn-modifier" style="margin-top: 30px">Génerer le planning</button>
        </form>

    </div>
    @section('script')

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                });
            </script>
        @endif
        @if(session()->has("success"))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{session()->get('success')}}",
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>
        @endif

    @stop
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@endsection

