@extends('layouts.app')
@section('title','Accueil')
@section('content')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <style>
        #essay{
            margin-left: 250px;
            margin-top: 10px;
            width: calc(100% - 250px);
            background-color: #FEF5E7;
        }
        #nij{
            background-color: #FEF5E7;
        }
        #header {
            background-color: #38512F;
            width: calc(100% - 14.08rem);
            float: right;
            height: 70px;
        }
        #body {
            background-color: #FEF5E7;
        }
        .page-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box {
            width: 600px;
            height: 500px;
            position: absolute;
            top: 65%;
            left: 60%;
            text-align: center;
            transform: translate(-50%, -50%);
            border-radius: 15px;
            text-decoration-color: #35512F;
        }
        #animated-text {
            margin-top:50px;
            margin-left:20px;
            font-size: 24px;
            font-family: Arial, sans-serif;
            color: #35512F;
            overflow: hidden;
            font-weight: bold;
        }
        .table-head {
            background-color: #f8f9fa;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
    </style>
    <div class="content-wrapper" id="essay">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
            </div>
        </div>
        <div id="body">

            <div class="box">
                <div id="animated-text">
                    <h4>Bienvenue dans votre espace enseignant !</h4>
                    <h4>Saisissez votre non-disponibilité, consultez vos emplois du temps des examens.</h4>
                </div>

                <!-- Tableau des plannings générés -->
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
                            <td><a href="{{ route('exporPdf', ['specialite' => $specialite]) }}"><i class="fas fa-file-pdf"></i> PDF</a></td>
                            <td><a href="{{ route('exporExcel', ['specialite' => $specialite]) }}"><i class="fas fa-file-excel"></i> Excel</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Aucun planning généré</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!-- Fin du tableau des plannings générés -->

            </div>

        </div>
    </div>
@endsection
