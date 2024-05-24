@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <link rel="stylesheet" href="{{ asset('CSS/sidebar.css') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        #mk{
        padding: 50px;
        padding-bottom: 10px;


        }
        .ui{
            border-radius: 10px;

        }

    </style>

    <div  id="essay">
        <div class="row" >
            <div class="col-md-8 mx-auto" >
            <div class="text-end"> <a href="{{ url('admin/admin/add')}}" >
                <img src="{{ asset('assets/add.png') }}" alt="Description de l'image">
            </a></div>
                @include('_message')
                <div class="card my-3" >
                    <div class="card-header">
                        <h3 class="text-center" >
                            List administrateur
                        </h3>
                    </div>
                    <div class="card-body" >
                        <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th >Action</th>
                                  </tr>

                            </thead>
                            <tbody>
                                @foreach ($getRecord as $value )
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <a href="{{ url('admin/admin/edit/'.$value->id)}}" class="btn btn-sm btn-warning mx-2">
                                            <i class="fas fa-edit"></i></a>
                                        <form id="{{$value->id}}" action="{{route('destt',$value->id)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                        <button onclick="deleteAd({{$value->id}})"
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

    </div>
    @section('script')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv', 'pdf', 'print'
                ]
            });
        });
    </script>
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
    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
@endsection

