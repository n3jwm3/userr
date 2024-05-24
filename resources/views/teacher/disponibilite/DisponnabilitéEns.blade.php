@extends('layouts.app')
@section('content')
        <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="stylesheet" href="https://cdn.datatables.net/v/bs4/dt-1.10.24/b-1.7.0/b-html5-1.7.0/b-print-1.7.0/r-2.2.7/datatables.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">

        <title>non disponibilité</title>


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

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



           .box h4 {
               color: #000000; /* Couleur noire */
           }

        </style>




    <div id="body">
         <div  class="box">
            <div>
             <h6 class="text-center" id="mk">Effectuer les opérations d'ajout, modification, suppression sur vos non-disponnibilités </h6>
            </div>

            <div class="row" >

                <div class="col-md-9 mx-auto" >

                    <div class="text-end"> <a href="{{ url('teacher/disponibilite/add')}}" >

                        <img src="{{ asset('assets/add.png') }}" alt="Description de l'image">

                    </a></div>


                    @include('_message')
                    <div class="card my-3" >
                        <div class="card-header">
                            <h3 class="text-center " >
                                Non-disponnibilité
                            </h3>
                        </div>
                        <div class="card-body" >
                            <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
                                <thead>
                                    <tr>

                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Crenaux</th>
                                        <th>Actions</th>
                                    </tr>

                                </thead>

                                <tbody>
                                @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->jour }}</td>

                                    <td>
                                  @if ( $value->crenaux == '8h-10h')
                                      <span >8h-10h</span>
                                   @elseif ( $value->crenaux == '10h-12h')
                                    <span >10h-12h</span>
                                    @elseif ( $value->crenaux == '12h-14h')

                                    <span >12h-14h</span>
                                    @elseif ( $value->crenaux == '14h-16h')

                                    <span >14h-16h</span>


                                    @endif
                                    @php
                                         $crenaux = explode(',',  $value->crenaux); // Séparer les créneaux par des virgules
                                 @endphp
                             @foreach ($crenaux as $crenaux)
                                <span>{{ $crenaux }}</span><br>
                            @endforeach


                                    </td>

                                    <td class="d-flex justify-content-center align-items-center">

                                       {{-- <a href="{{ route('#', $value->id) }}"
                                            class="btn btn-sm btn-warning mx-2">
                                            <i class="fas fa-edit"></i>
                                        </a>--}}

                                        <form id="{{$value->id}}" action="{{route('strdis',$value->id)}}"
                                         method="post">
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
