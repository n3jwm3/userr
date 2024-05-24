<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <!-- Styles -->
    <style>
        .custom-navbar {
            background-color: #38512F !important; /* Utilisation de la couleur verte spécifique en hexadécimal */
        }
        .custom-bold-text {
            font-weight: bold;
        }
        #header {
            background-color: #38512F;
            width: calc(100% - 14.08rem);
            float: right;
            height: 70px;
        }
        body {
            background-color: #FEF5E7; /* Changer la couleur de fond de l'interface en #FEF5E7 */
        }
        .box {
            margin-top: 110px;
            width: 500px;
            height: 400px;
            position: absolute; /* Position absolue par rapport au corps */
            top: 40%; /* Place le haut de la boîte à 50% de la hauteur du corps */
            left: 60%; /* Place la gauche de la boîte à 50% de la largeur du corps */
            text-align: center;
            transform: translate(-50%, -50%); /* Centre la boîte horizontalement et verticalement */
            background-color: white; /* Fond du formulaire en blanc */
            border-radius: 15px;
        }
        #aj {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            color: white;
            background-color: #35512f;
            cursor: pointer;
        }
        #body {
            background-color: #FEF5E7; /* Changer la couleur de fond de l'interface en #FEF5E7 */
        }
    </style>
</head>
<body id="body">
<header id="header">
    <nav class="navbar navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('ImagesCoteEnseignant/Disponiblité.png') }}"
                     width="32" height="32" class="d-inline-block align-text-top">
                <span class="custom-bold-text text-white">Non-disponibilite</span>
            </a>
        </div>
    </nav>
</header>
<div class="box" id="ski">
    <div class="card-body">
        <!-- Bouton de retour -->
        <div class="text-end" id="hov">
            <a href="{{ route('DisponnabilitéEns') }}">
                <i class="fa-solid fa-xmark fa-xl"></i>
            </a>
        </div>
        <!-- Formulaire de modification -->
        <form method="POST" class="mt-3" action="{{ route('upd', $disponibilite->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Utilisez la méthode PUT pour la mise à jour -->

            <!-- Champs pré-remplis avec les valeurs actuelles -->
            <div class="form-group mb-5" id="in3">
                <h5>Modifier votre date</h5>
                <div class="col-7 mx-auto">
                    <input type="date" name="jour" class="form-control" value="{{ $disponibilite->jour }}" required>
                </div>
            </div>

            <div class="form-group mb-5" id="in3">
                <h5>Modifiez les créneaux </h5>
                <div class="col-7 mx-auto">
                    <select name="crenaux[]" id="crenaux" multiple>
                        @foreach($crenaux as $crenaux)
                            <option value="{{ $crenaux }}" {{ in_array($crenaux, explode(',', $disponibilite->crenaux)) ? 'selected' : '' }}>
                                {{ $crenaux }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
            <script>
                new MultiSelectTag('crenaux')  // id
            </script>
            <!-- Bouton de modification -->
            <div class="btnajt d-flex justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn" id="aj" style="background-color: #35512F; color: white;">
                        {{ __('Modifier') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="Bar">
    @include('CoteEnseignant.BarreDeMenuEns')
</div>
</body>
</html>
