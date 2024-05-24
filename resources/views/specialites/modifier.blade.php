@extends('layouts.app')



@section('content')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    {{-- link au css --}}
    <link rel="stylesheet" href="/Css/modifier.css">

    {{-- link de bootstrap --}}
    <link rel="stylesheet" href="/bootstrap-5.0.2-dist/css/bootstrap.css">

    {{-- link de fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <section class="container" id="sec1">

        <form action="admin/specialites/update/traitement" method="POST">
            @csrf

            <!-- ID de la spécialité (lecture seule) -->
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">id:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="id" value="{{ $spec->id }}" readonly>
                </div>
            </div>

            <!-- Nom de la spécialité -->
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Nom:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="nom" value="{{ $spec->nom }}">
                </div>
            </div>

            <!-- Département de la spécialité -->
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Département:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="departement" value="{{ $spec->departement }}">
                </div>
            </div>

            <!-- Niveau de la spécialité -->
            <div class="row">
                <div class="col-12 col-md-3">
                    <label for="">Niveau:</label>
                </div>
                <div class="col-12 col-md-9">
                    <input type="text" name="niveau" value="{{ $spec->niveau }}">
                </div>
            </div>

            <!-- Sections et groupes -->
            <div class="row">
                <div class="col-12">
                    <!-- Ajoutez ici les champs pour les sections et les groupes -->
                    <!-- Vous pouvez utiliser JavaScript pour gérer l'ajout et la suppression dynamique -->
                </div>
            </div>

            <!-- Bouton de soumission -->
            <div class="row">
                <div class="col-12">
                    <p style="text-align: center"><button type="submit" class="btnajouter">Modifier</button></p>
                </div>
            </div>
        </form>
    </section>

    {{-- message pour afficher que en a bien inséré dans la base de données  --}}
    @if (session('status'))
        <div class="alert success">
            {{ session('status') }}
        </div>
    @endif

    {{-- script pour js  --}}
    <script src="/bootstrap-5.0.2-dist/js/bootstrap.js"></script>

@endsection

@section('styles')
    <link rel="stylesheet" href="/CSS/Module.css">
@endsection
