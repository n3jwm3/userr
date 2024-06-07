@extends('layouts.app')
@section('title', 'Module')
@section('content')
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
        #sec1 {
            margin-top: 20px;
            background: white;
            padding: 20px;
            border-radius: 20px;
            width: 650px;
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
        .btnajouter:hover {
            background-color: #35dc3b;
        }
        .btnajouter a {
            text-decoration: none;
            color: white;
        }
        #countries {
            overflow: auto;
        }
        /* Adjustments to input fields and buttons */
        input[type="text"],
        input[type="number"],
        select {
            width: 100%; /* Utiliser toute la largeur disponible */
            padding: 8px;
            border-radius: 20px;
            border: 1px solid #ced4da;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        #buttmod {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f;
            cursor: pointer;
        }


        button[type="submit"],
        .btnajouter {
            width: 160px; /* Reduire la largeur */
            padding: 8px 15px; /* Reduire la hauteur */
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #35512f; /* Background color from the second code */
            padding-top: 20px;
            color: white; /* Text color from the second code */
        }
        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #35dc3b; /* Hover background color from the second code */
        }
        .main {
            margin-left: 250px; /* Same width as the sidebar */
            padding: 20px;
        }
    </style>

<div class="main" style="background: #FEF5E7">
    <div>
        <h6 class="text-center" id="mk">  <strong>Ajouter les coordonnées d'un module pour le modifier.</strong> </h6>
    </div>
    <section class="container" id="sec1">
        <div class="text-end" id="hov">
            <a href="{{ route('Modules.module') }}">
                <i class="fa-solid fa-xmark fa-xl"></i>
            </a>
        </div>
        <form action="/updatemodule/traitement" method="post">
            @csrf
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">id:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input  type="text" name="id" value="{{$mo->id}}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Libelle:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input  type="text" name="libelle" value="{{$mo->libelle}}">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Semestre:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input  type="text" name="semestre" value="{{$mo->semestre}}">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Specialite:</label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="specialite_id" id="">
                        @foreach ($sp as $s)
                            <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Les chargés:</label>
                </div>
                <div class="col-12 col-md-9">
                    <select name="user_id[]" id="countries" multiple style="width: 200px">
                        @foreach ($ens as $ens)
                        @if ($ens->user_type === 2)
                            <option value="{{$ens->id}}" {{ in_array($ens->id, $enseignants_module) ? 'selected' : '' }}>{{$ens->nom}} {{$ens->prenom}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p style="text-align: center"><button type="submit" class="btnajouter" id="buttmod">Modifier</button></p>
                </div>
            </div>
        </form>
    </section>
    @if (session('status'))
        <div class="alert success">
            {{ session('status') }}
        </div>
    @endif
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('countries')
    </script>
    <script src="/bootstrap-5.0.2-dist/js/bootstrap.js"></script>
</div>
@endsection


