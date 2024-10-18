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
        </form>
        <form action="/valider_planning" method="get">
            @csrf
            <button type="submit">Valider</button>
        </form>
    </div>
</div>

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
@if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            });
        </script>
    @endif
     @if(session()->has("success"))
     <script>
         Swal.fire({
             position: 'top-end',
             icon: 'success',
             title: "{{session()->get('success')}}",
             showConfirmButton: false,
             timer: 3500
         });
     </script>
 @endif

    @stop
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

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
                @foreach ($modules as $m)
                    <input type="hidden" name="ids[]" value="{{ $m->id }}">
                @endforeach
                <button type="submit">Supprimer</button>
            </form>

            <form action="/valider_planning" method="get">
                @csrf
                <button type="submit">Valider</button>
            </form>
        </div>
    </div>
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
        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                });
            </script>
        @endif
        @if(session()->has("success"))
            <script>
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: "{{session()->get('success')}}",
                    showConfirmButton: false,
                    timer: 3500
                });
            </script>
        @endif

    @stop
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
@endsection
