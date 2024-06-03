@extends('layouts.app')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
          crossorigin="anonymous">
    <title>Disponibilite</title>

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
            height: 70px;}
        #body {
            background-color: #FEF5E7; /* Changer la couleur de fond de l'interface en #FEF5E7 */
        }
        #body {
            background-color: #FEF5E7; /* Changer la couleur de fond de l'interface en #FEF5E7 */
        }
        .box {
            width: 400px;

            border-radius: 15px;
        }
        /* Styles pour reproduire la mise en forme du deuxième code */
        /* Même style pour le conteneur principal */
        #ski {
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            margin-top: 40px;
        }
        /* Styles pour les champs de formulaire */
        h5{
            width: 100%;
            color: #35512F;
            text-decoration-color: black;
        }
        /* Bouton Ajouter */
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
        #essay{
            margin-left: 250px;
    margin-top: 10px;
    width: calc(100% - 250px);

    background-color: #FEF5E7;
        }
    </style>
<div id="essay">
<div id="body" style="margin-left: 250px;">

<div class="box" id="ski" style="background:white ;">
    <div class="card-body" style="background: white">
        <div class="text-end" id="hov">
            <a href="{{route('lo')}}" >
                <i class="fa-solid fa-xmark  fa-xl" ></i>
            </a>
        </div>
        <form method="POST" class="mt-3" action="{{ route('str') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-5" id="in3">
                <h5 >Choisissez votre date et Choisissez les crenaux </h5>
                <div class="col-7 mx-auto">
                    <select name="crenau_id" class="form-control" required>
                        <option value="">Sélectionner un créneau</option>
                        @foreach($crenaux as $creneau)
                            <option value="{{ $creneau->id }}">
                                {{ $creneau->crenaux }} - {{ $creneau->jour->jour }}
                            </option>
                        @endforeach
                    </select>
                </div> 
            </div>

            <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
            <script>
                new MultiSelectTag('crenaux')  // id
            </script>
            <div class="btnajt d-flex justify-content-center">
                <div class="col-md-8">
                    <button type="submit" class="btn"  id="aj">
                        {{ __('Ajouter') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
</div>
@endsection

