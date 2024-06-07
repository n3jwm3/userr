@extends('layouts.app')

@section('title', 'Enseignant')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <style>
        /* Styles pour la mise en forme des éléments de formulaire */
        #mk,
        #buttmod,
        #bordno,
        #bordpre,
        #bornum,
        #borem,
        #om,
        #borspe,
        #borspee,
        #mkl,
        #borgr {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #ffffff;
            margin-bottom: 10px;
        }

        #buttmod {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            background-color: #35512f;
            color: #fff;
            border: none;
            padding: 10px;
            margin-left: 0;
        }

        #buttmod:hover {
            background-color: #35dc3b;
            border-color: #35dc3b;
        }

        #buttmod:active {
            background-color: #35dc49;
            border-color: #35dc49;
        }

        /* Styles pour le lien au survol */
        #hov a {
            color: #0a53be;
            text-decoration: none;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row my-5">
                    <div class="col-md-6 mx-auto">
                        @include('alert')
                    </div>
                </div>
                <div class="card my-5" id="edii">

                    <div class="card-header text-center p-3">
                        <div class="text-end" id="hov">
                            <a href="{{route('local.index')}}">
                                <i class="fa-solid fa-xmark fa-xl"></i>
                            </a>
                        </div>
                        <h3 class="text-dark">
                            Modification
                        </h3>
                    </div>
                    <div class="card-body">

                        <form method="POST" class="mt-3" action="{{ route('local.update',$local->libelle) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div id="ided">
                                <div class="form-group mb-4" id="spasnom">
                                    <label class="form-label fw-bold" for="libelle" >libelle</label>
                                    <input type="text" name="libelle" value="{{old("libelle",$local->libelle)}}" placeholder="libelle" class="form-control" id="bordpre">
                                </div>
                            </div>
                            <div id="ided">
                                <div class="form-group mb-4">
                                    <label for="capacite" class="form-label fw-bold">capacite</label>
                                    <input type="number" name="capacite" maxlength="3" value="{{old("capacite",$local->capacite)}}" placeholder="capacite" class="form-control" id="bordpre">
                                </div>
                            </div>
                            <div id="ided">
                                <div class="form-group mb-4" id="spasnom">
                                    <label class="form-label fw-bold" for="type">Type</label>
                                    <select name="type" class="form-control" id="bornum" required>
                                        <option value=""  disabled>
                                            Type
                                        </option>
                                        <option {{ $local->type === "Salle" ? "selected" : "" }} value="Salle">Salle</option>
                                        <option {{$local->type === "Amphi" ? "selected" : "" }} value="Amphi">Amphi</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-dark" id="buttmod">{{ __('  Modification') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




