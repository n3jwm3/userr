@extends('layouts.app')
@section('title', 'Module')
@section('content')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- lien pour la selection multiple --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">

    {{--  le lien de css de sabrina --}}
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <link rel="stylesheet" href="{{ asset('CSS/Module.css')}}">
    <style>
        /* Ajoutez ce style pour appliquer le défilement au select */
        .select2-wrapper select {
            overflow-y: auto;
            max-height: 200px; /* Vous pouvez ajuster la hauteur maximale selon vos besoins */
        }

    </style>

    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            @include('alert')
        </div>
    </div>
    <div class="col-md-10 mx-auto">
        <div style="text-align: right;">
            {{-- <button class="btn btn-success" id="btnajoutm">Ajouter un module</button> --}}
            <img src="{{ asset('assets/add.png') }}" alt="Description de l'image" id="btnajoutm">
        </div>
    </div>

    {{-- la div de sabrina--}}
    <div class="card my-2 col-md-10 mx-auto">
        <div class="card-header">
            <h3 class="text-center " >
                Modules
            </h3>
        </div>
        <div class="card-body" >
            <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
                <thead>
                <tr class="table-head">
                    <th>Code du module/ID</th>
                    <th>Libellé</th>
                    <th>Spécialite</th>
                    <th>Semestre</th>
                    <th>Chargé du module</th>
                    <th>Actions</th>
                </tr>

                </thead>
                <tbody>
                @foreach ($mod as $m)
                    <tr>
                        <td>{{ $m->id }}</td>
                        <td>{{ $m->libelle }}</td>
                        <td>{{ $m->specialite->nom}} </td>
                        <td>
                            @if ($m->semestre  == '1')
                                <span >1</span>
                            @elseif ($m->semestre == '2')
                                <span >2</span>
                            @endif
                        </td>
                        <td>
                            @foreach ($m->users as $e)
                                <ul>
                                    <ol>{{$e->name}} {{ $e->prenom}}</ol>
                                </ul>
                            @endforeach

                        </td>
                        <td class="d-flex justify-content-center align-items-center">
                            <a href="/update_module/{{ $m->id }}" class="btn btn-sm btn-warning mx-2"><i class="fas fa-edit"></i></a>
                            <form id="{{$m->id}}" action="{{route("strmodule",$m->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                            </form>
                            <button onclick="deleteAd({{$m->id}})"
                                    type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                            {{--<a href="/delete_module/{{ $m->id }}" class="btn  btn-sm  btn-danger"><i class="fa fa-trash"></i></a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
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

    <!-- Modal AJOUT MODULE -->
    <div class="modall" id="resource-modal">
        <!-- Header -->
        <div class="modal-header">
            <h3 class="modal-heading">Ajouter un nouveau module</h3>
            <button class="close"> <span>x</span></button>
        </div>
        <hr class="modal-divider">

        <!-- Content -->
        <div class="modal-content">
            <form action="/add/traitement" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                        <div class="form-group">
                            <label style="margin-right: 120px">Libelle : </label>
                            <input type="text" name="libelle" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label >Le semestre</label>
                                <div class="select2-wrapper" style="margin-top: 10px">
                            <select name="semestre" class="form-control" id="numbor" required>
                                <option value="" selected disabled>Semestre</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label >La Spécialite</label>
                                <div class="select2-wrapper" style="margin-top: 10px">
                                    <select name="specialite_id" id="" style="width: 100%" required>
                                        @foreach ($spec as $s)
                                            <option value="{{$s->id}}">{{$s->nom}} {{$s->niveau}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Les chargés</label>
                            <div class="select2-wrapper" style="margin-top: 10px">
                                <select name="user_id[]" id="countries" multiple style="overflow: auto" required>
                                    @foreach ($ens as $e)
                                        @if ($e->user_type === 2)
                                            <option value="{{$e->id}}">{{$e->name}} {{$e->prenom}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="row">
                            <hr class="modal-divider">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-offset-1 col-md-offset-1">
                                <button type="button" class="btn btn-danger btn-block" data-dismiss="modal" id="annuler">Annuler</button>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5">
                                <button type="submit" class="submit-btn btn btn-primary btn-block" id="ajouter">Ajouter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Footer -->

    </div>


    <script>
        const selectWrapper = document.querySelector('.select2-wrapper');
        selectWrapper.style.overflow = 'visible';
        // Sélectionnez le bouton "Ajouter un module"
        const btnajout = document.getElementById('btnajoutm');

        // Sélectionnez le modal à afficher
        const resourceModal = document.getElementById('resource-modal');

        // Sélectionnez l'élément de fermeture du modal
        const closeBtn = document.querySelector('.close');

        // Ajoutez un écouteur d'événement pour détecter le clic sur le bouton
        btnajout.addEventListener('click', function() {
            // Afficher le modal
            resourceModal.style.display = 'block';
        });

        // Ajoutez un écouteur d'événement pour détecter le clic sur le bouton de fermeture
        closeBtn.addEventListener('click', function() {
            // Cacher le modal
            resourceModal.style.display = 'none';
        });
        // Sélection du select element
        const selectElement = document.getElementById('professors-select');

        // Sélection du span pour afficher les options sélectionnées
        const selectedProfessorsSpan = document.getElementById('selected-professors');

        // Écouter les changements dans la sélection
        selectElement.addEventListener('change', function() {
            // Créer un tableau pour stocker les options sélectionnées
            const selectedProfessors = [];

            // Boucler à travers toutes les options et vérifier celles qui sont sélectionnées
            for (const option of selectElement.selectedOptions) {
                selectedProfessors.push(option.textContent);
            }

            // Mettre à jour le contenu du span avec les options sélectionnées
            selectedProfessorsSpan.textContent = selectedProfessors.join(', ');
        });

        // Au moment d'ajouter un module, vous pouvez envoyer une requête AJAX pour l'ajouter à la base de données.
        document.getElementById('ajouter').addEventListener('click', function() {
            const nomModule = document.querySelector('input[name="name"]').value;
            const professeursSelect = document.getElementById('professors-select');
            const professeursSelectionnes = Array.from(professeursSelect.selectedOptions).map(option => option.textContent);

            // Envoyer une requête AJAX pour ajouter le module à la base de données
            $.ajax({
                type: 'POST',
                url: 'ajouter_module.php', // Endpoint pour l'ajout du module
                data: {
                    nom: nomModule,
                    professeurs: professeursSelectionnes
                },
                success: function(response) {
                    // Gérer la réponse
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Gérer les erreurs
                    console.error(error);
                }
            });
        });

        // Sélectionnez le bouton "Annuler"
        const btnAnnuler = document.getElementById('annuler');

        // Ajoutez un gestionnaire d'événements pour détecter le clic sur le bouton "Annuler"
        btnAnnuler.addEventListener('click', function() {
            // Sélectionnez le formulaire
            const form = document.getElementById('resource-form');

            // Réinitialisez les champs du formulaire
            form.reset();

            // Réinitialisez les sélections
            const selectElements = document.querySelectorAll('.select2');
            selectElements.forEach(function(selectElement) {
                selectElement.value = ''; // Réinitialisez la sélection à la valeur vide
            });

            // Réinitialisez l'affichage des options sélectionnées
            const selectedProfessorsSpans = document.querySelectorAll('#selected-professors');
            selectedProfessorsSpans.forEach(function(selectedProfessorsSpan) {
                selectedProfessorsSpan.textContent = ''; // Effacez le contenu du span
            });

            // Cacher le modal
        });
    </script>


    {{-- script pour la selection multiple --}}
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('countries')  // id
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
@endsection

