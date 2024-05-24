@extends('layouts.app')
@section('styles')
    <style>
        /* Copiez le CSS du deuxième code ici */
        #ski {
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh;
        }

        .card-body {
            width: 800px;
            padding: 20px;
            height: 350px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        #aj {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f;
            color: #fff;
            cursor: pointer;
        }

        /* Nouvelles règles pour disposer les champs en ligne */
        .inline-form {
            display: flex;
            flex-wrap: wrap;
        }




        #essay{
            margin-left: 850px;
            width: calc(100% - 250px);
         background-color: #FEF5E7;
        }
    </style>
@endsection

@section('content')

    <div class="container" id="essay" style="margin-left: 250px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row my-5">
                    <div class="col-md-6 mx-auto">
                        @include('alert')
                    </div>
                </div>
                <div class="card my-5" id="ski">
                    <div class="card-body">
                        <div class="text-end" id="hov">
                            <a href="{{route('listte')}}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                            </a>
                        </div>
                        @if ($user)
                        <!-- Utilisation des classes pour disposer les champs en ligne -->
                        <div class="inline-form">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label fw-bold">Nom</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->name}}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="prenom" class="form-label fw-bold">Prénom</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->prenom}}
                                </div>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div class="form-group mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->email}}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="mot_de_passe" class="form-label fw-bold">Mot de passe</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->password}}
                                </div>
                            </div>
                        </div>
                        <div class="inline-form">
                            <div class="form-group mb-3">
                                <label for="type" class="form-label fw-bold">Type</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->type}}
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="grade" class="form-label fw-bold">Grade</label>
                                <div class="border border-success rounded-pill rounded p-2">
                                    {{$user->grade}}
                                </div>
                            </div>
                        </div>
                        @else
                        <p>Utilisateur non trouvé.</p>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
