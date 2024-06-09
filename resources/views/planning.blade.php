{{--@extends('layouts.app')
@section('title','Planing')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/app.css') }}">

<div class="row my-5">
    <div class="col-md-6 mx-auto">
        @include('alert')
    </div>
</div>

<div class="card my-2 col-md-10 mx-auto">
    <div class="card-header">
        <h3 class="text-center">Planning</h3>
    </div>
    <div class="card-body">
        <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Crenaux</th>
                    <th>Local</th>
                    <th>Groupe</th>
                    <th>Surveillant</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                @php
                $locals = $module->examens->groupBy('local.libelle');
                $totalRows = count($locals);
                @endphp
                @foreach ($locals as $localName => $examsInLocal)
                @php
                $crenauxList = $examsInLocal->pluck('crenau')->unique('crenaux');
                $uniqueSurveillants = $examsInLocal->pluck('enseignants')->flatten()->unique('id');
                @endphp
                <tr>
                    @if ($loop->first)
                    <td rowspan="{{ $totalRows }}">{{ $module->libelle }}</td>
                    @endif
                    <td>
                        @foreach ($crenauxList as $crenau)
                        {{ $crenau->jour->jour }} {{ $crenau->crenaux }}<br>
                        @endforeach
                    </td>
                    <td>{{ $localName }}</td>
                    <td>
                        @foreach ($examsInLocal as $examen)
                        @foreach ($examen->groupes as $groupe)
                        {{ $groupe->nom }}
                        @endforeach
                        @endforeach
                    </td>
                    <td>
                        @foreach ($uniqueSurveillants as $enseignant)
                        {{ $enseignant->nom }}<br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
    $('#myTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
    'copy', 'excel', 'csv', 'pdf', 'print'
    ]
    });
    });
</script>
@endsection

@section('styles')
<link rel="stylesheet" href="/CSS/Module.css">
@endsection--}}
 @extends('layouts.app')
 @section('title','Planing')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="{{ asset('assets/app.css') }}">

<div class="row my-5">
    <div class="col-md-6 mx-auto">
        @include('alert')
    </div>
</div>

<div class="card my-2 col-md-10 mx-auto">
    <div class="card-header">
        <h3 class="text-center">Planning</h3>
    </div>
    <div class="card-body">
        <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Crenaux</th>
                    <th>Local</th>
                    <th>Groupe</th>
                    <th>Surveillant</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                @php
                $locals = $module->examens->groupBy('local.libelle');
                $totalRows = count($locals);
                @endphp
                @foreach ($locals as $localName => $examsInLocal)
                @php
                $crenauxList = $examsInLocal->pluck('crenau')->unique('crenaux');
                $uniqueSurveillants = $examsInLocal->pluck('users')->flatten()->unique('id');
                @endphp
                <tr>
                    @if ($loop->first)
                    <td rowspan="{{ $totalRows }}">{{ $module->libelle }}</td>
                    @endif
                    <td>
                        @foreach ($crenauxList as $crenau)
                        {{ $crenau->jour->jour }} {{ $crenau->crenaux }}<br>
                        @endforeach
                    </td>
                    <td>{{ $localName }}</td>
                    <td>
                        @foreach ($examsInLocal as $examen)
                        @foreach ($examen->groupes as $groupe)
                        {{ $groupe->nom }}<br>
                        @endforeach
                        @endforeach
                    </td>
                    <td>
                        @foreach ($uniqueSurveillants as $enseignant)
                        {{ $enseignant->name }}<br>
                        @endforeach
                    </td>
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
    <div>
        <form action="/delete_planning" method="post">
            @csrf
            <button type="submit">Supprimer</button>
            <button>Valider</button>
        </form>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'excel', 'csv', 'pdf', 'print'
            ]
        });
    });
</script>
@endsection

@section('styles')
<link rel="stylesheet" href="/CSS/Module.css">
@endsection

