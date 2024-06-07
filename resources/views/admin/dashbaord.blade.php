@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    <style>
        #nij {
            background-color: #FEF5E7;
        }
        .bloc img {
            width: 60px;
            height: 55px;
        }
        #im {
            background-color: #fff;
        }
        #ml {
            margin-top: 20px;
        }
    </style>

    <div class="content-wrapper" id="nij">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="container-fluid" id="ml">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <div class="small-box" id="im">
                                    {{--<img src="{{ asset('Images/specialite-removebg-preview.png') }}" alt="Description de l'image" >--}}
                                    <div class="icon">
                                        <i class="fas fa-chalkboard-teacher" style="color:#35512f;"></i>
                                    </div>
                                    <div class="inner">
                                        <h3>{{ \App\Models\User::where('user_type', 2)->count() }}</h3>
                                        <p>Enseignants</p>
                                    </div>
                                    <div class="small-box-footer">Enseignants</div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box" id="im">
                                    <div class="inner">
                                        <h3>{{ \App\Models\specialite::count() }}</h3>
                                        <p>Spécialités</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-graduation-cap" style="color:#35512f;"></i>
                                    </div>
                                    <div class="small-box-footer">Spécialités</div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box" id="im">
                                    <div class="inner">
                                        <h3>{{ \App\Models\Local::count() }}</h3>
                                        <p>Locaux</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-building" style="color:#35512f;"></i>
                                    </div>
                                    <div class="small-box-footer">Locaux</div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <div class="small-box" id="im">
                                    <div class="inner">
                                        <h3>{{ \App\Models\Groupe::sum('nombre_etudiant') }}</h3>
                                        <p>Etudiants</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-person" style="color:#35512f;"></i>
                                        {{-- <div class="bloc"><img src="{{ asset('Images/specialite-removebg-preview.png') }}" alt="Description de l'image" ></div> --}}
                                    </div>
                                    <div class="small-box-footer">Etudiants</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Code for displaying generated timetables -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <table class="table table-bordered" style="margin-top: 50px">
                                <thead>
                                <tr class="table-head">
                                    <td>Libellé de l'emploi du temps</td>
                                    <td>Version PDF</td>
                                    <td style="width: 10%">Version Excel</td>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td> texte</td>
                                        <td>texte</td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="pagination">
                            </div>
                            <div class="no-data text-center">
                                <p>Aucun planning généré</p>
                            </div>
                    </div>
                    <!-- End of timetable display code -->

                </div>
            </div>
        </div>
    </div>
@endsection
