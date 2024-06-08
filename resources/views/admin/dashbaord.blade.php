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
        .table-head {
            background-color: #f8f9fa; /* Couleur d'en-tête de tableau */
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6; /* Bordure des cellules */
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
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
                                        <h3>{{ \App\Models\Specialite::count() }}</h3>
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
                                <th>Libellé de l'emploi du temps</th>
                                <th>Version PDF</th>
                                <th style="width: 10%">Version Excel</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($examens->groupBy('module.specialite.nom') as $specialite => $examenGroup)
                                <tr>
                                    <td>Planning d'examen {{ $specialite }}</td>
                                    <td><a href="{{ route('exportPdf', ['specialite' => $specialite]) }}"><i class="fas fa-file-pdf"></i> PDF</a></td>
                                    <td>
                                        <a href="{{ route('exportExcel', ['specialite' => $specialite]) }}"><i class="fas fa-file-excel"></i> Excel</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Aucun planning généré</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- End of timetable display code -->

                </div>
            </div>
        </div>
    </div>
@endsection
