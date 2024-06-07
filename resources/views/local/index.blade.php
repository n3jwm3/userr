@extends('layouts.app')
@section('title', 'Local')
@section('content')
<link rel="stylesheet" href="{{ asset('assets/app.css')}}">
<style>
     #aj {
            width: 100px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f;
            color: #fff;
            cursor: pointer;
        }

</style>

<div class="row">
    <div class="col-md-8 mx-auto">

        <form action="{{ url('import_excel_local') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
           <div class="mb-3" style="width: 500px;">
               <label for="file">Sélectionnez le fichier Excel à importer</label>

           </div>
           <div class="d-flex">
            <input class="form-control me-2" type="file" id="formFileExcel" name="excel-file" style="width: auto;">
           <button type="submit"  class="btn btn-dark" id="aj">Importer</button>
           </div>
       </form>
       @include('_message')

        <div class="text-end"> <a href="{{ route('local.create') }}" >

            <img src="{{ asset('assets/add.png') }}" alt="Description de l'image">

        </a></div>

        <div class="card my-3">
            <div class="card-header">
                <h3 class="text-center ">
                Locals
                </h3>
            </div>
            <div class="card-body">
                <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>libelle</th>
                            <th>capacite</th>
                            <th>type</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($local as $key => $local)
                            <tr>
                                <td>{{$key+=1}}</td>
                                <td>{{$local->libelle}}</td>
                                <td>{{$local->capacite}}</td>
                                <td>
                                    @if ($local->type == 'Salle')
                                  <span >Salle</span>
                               @elseif ($local->type == 'Amphi')
                                <span >Amphi</span>

                            @endif
                                </td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a href="{{route('local.edit',$local->libelle)}}"
                                        class="btn btn-sm btn-warning mx-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form id="{{$local->id}}" action="{{route("local.destroy",$local->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                    </form>
                                    <button onclick="deleteAd({{$local->id}})"
                                        type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'print'
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
<script>
    function deleteAd(id){
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Tu es sûr ?',
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimez-le !',
                cancelButtonText: 'Non, annulez!',
                reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(id).submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Annulé',
                    'annulé',
                    'error'
                )
            }
            })
    }
</script>


@stop
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@endsection



