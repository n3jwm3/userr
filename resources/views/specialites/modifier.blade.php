<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Specialite</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/Css/modifier.css">
    <link rel="stylesheet" href="/Css/addformation.css">
    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

    <!-- Custom Styles -->
    <style>
        /* Your custom styles here */
        /* Example: */
        /* CSS */
        /* #id-field {
             display: none; /* Cacher le champ de l'id */


        #sec1 {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            width: 750px;
            margin-left: 350px;
        }
        .container {
            margin-bottom: 50px;
        }
        .btnajouter {
            background-color: #35512f;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #countries {
            overflow: auto;
        }
        /* Adjustments to input fields and buttons */
        input[type="text"],
        input[type="number"],
        select{
            width: 80%; /* Utiliser toute la largeur disponible */
            padding: 8px;
            border-radius: 20px;
            border: 1px solid #ced4da;
            margin: 5px;
            box-sizing: border-box;
        }
        button[type="submit"],
        .btnajouter {
            width: 100%; /* Reduire la largeur */
            padding: 10px; /* Reduire la hauteur */
            border-radius: 5px;
            background-color: #35512f;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }



    </style>
</head>
<body>

@extends('layouts.app')

@section('title', 'Modifier Specialite')

@section('content')

    <form action="/update/traitement" method="POST">

        @csrf
        <section class="container" id="sec1">
            <div class="text-end" id="hov">
                <a href="{{ route('specialites.specialite') }}" style="margin-left:700px;">
                    <i class="fa-solid fa-xmark fa-xl"></i>
                </a>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="" id="id-field">id:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="id" id="id-field" value="{{ $spec->id }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Nom:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="nom" value="{{ $spec->nom }}">
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Département:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="departement" value="{{ $spec->departement }}">
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Niveau:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="niveau" value="{{ $spec->niveau }}">
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    @foreach($sections as $section)
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <label for="">Section:</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" name="sections[{{ $section->id }}]" value="{{ $section->nom }}">
                            </div>
                        </div>
                        <!-- HTML -->
                        @foreach($section->groupes as $group)
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <label for="">Groupe:</label>
                                </div>
                                <div class="col-12 col-md-4"> <!-- Div pour le champ input -->
                                    <input type="text" name="groupes[{{ $section->id }}][{{ $group->id }}][nom]" value="{{ $group->nom }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label for="">Nombre d'étudiants:</label>
                                </div>
                                <div class="col-12 col-md-2"> <!-- Div pour le champ input -->
                                    <input type="number" name="groupes[{{ $section->id }}][{{ $group->id }}][nombre_etudiants]" value="{{ $group->nombre_etudiant }}">
                                </div>
                            </div>
                        @endforeach

                    @endforeach
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <p style="text-align: center"><button type="submit" class="btnajouter">Modifier</button></p>
                </div>
            </div>
    </form>
    </section>

@endsection

</body>
</html>
