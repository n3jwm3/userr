@extends('layouts.app')

@section('content')

    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    {{-- lien pour la selection multiple --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">


    {{--  le lien de css de sabrina --}}
    <link rel="stylesheet" href="{{ asset('assets/app.css')}}">
    <link rel="stylesheet" href="{{ asset('CSS/Module.css')}}">

    <style>
        #mk{
            padding: 0px;
            padding-bottom: 10px;


        }
             /* Style pour le bouton personnalisé */
         .custom-btn {
             color: black; /* Couleur du texte en vert */
             background-color: white; /* Fond blanc */
             border: none;
         }
         #essay{
            margin-left: 250px;
          width: calc(100% - 250px);
          background-color: #FEF5E7;
        }

    </style>

    <div>
    <div class="row my-5">
        <div class="col-md-6 mx-auto">
            @include('alert')
        </div>
    </div>

    <div class="col-md-10 mx-auto">
        <div style="text-align: right;">
            {{-- <button class="btn btn-success" id="btnajoutm" style="background-image: url({{ asset('assets/add.png') }})"></button> --}}
            <img src="{{ asset('assets/add.png') }}" alt="Description de l'image" id="btnajoutm">
        </div>




    {{-- la div de sabrina--}}
    @include('_message')
    <div class="card my-2 col-md-12 mx-auto">
        <div class="card-header">
            <h3 class="text-center " >
                spécialités
            </h3>
        </div>
        <div class="card-body" >
            <table id="myTable" class="table table-bordered table-striped table-hover table-responsive-sm">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Departement</th>
                    <th>Niveau</th>
                    <th>Sections et Groupes</th>
                    <th>Actions</th>
                </tr>

                </thead>
                <tbody>
                @foreach ($specia as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->nom }}</td>
                        <td>{{ $s->departement }}</td>
                        <td>{{ $s->niveau }}</td>
                        <td>
                            {{-- afficher les sections --}}
                            @foreach ($s->sections as $sec)
                                <div>
                                    <p>Section : {{$sec->nom}}</p>
                                    @foreach ($sec->groupes as $gr)
                                        <p>Groupe : {{$gr->nom}} Nombre etudiant : {{$gr->nombre_etudiant}}</p>
                                    @endforeach
                                </div>
                            @endforeach
                        </td>

                        <td class="d-flex justify-content-center align-items-center">
                            <a href="/update_formation/{{ $s->id }}" class="btn btn-sm btn-warning mx-2"><i class="fas fa-edit"></i></a>
                            <form id="{{$s->id}}" action="{{route("strformation",$s->id)}}" method="post">
                                @csrf
                                @method("DELETE")
                            </form>
                            <button onclick="deleteAd({{$s->id}})"
                                type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                            {{--<a href="/delete_formation/{{ $s->id }}" class="btn  btn-sm  btn-danger"><i class="fa fa-trash"></i></a>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

</div>

    <!-- Modal AJOUT MODULE -->
    <div class="modall" id="resource-modal">
        <!-- Header -->
        <div class="modal-header">
            <h3 class="modal-heading">Ajouter une nouvelle spécialité</h3>
            <button class="close"> <span>x</span></button>
        </div>
        <hr class="modal-divider">
        <!-- Content -->
        <div class="modal-content">
            <form action="/ajouter/traitement" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
                        <div class="form-group">
                            <label style="margin-right: 156px">Nom : </label>
                            <input type="text" name="nom">
                        </div>
                        <div class="form-group">
                            <label style="margin-right: 100px">Département : </label>
                            <input type="text" name="departement">
                        </div>
                        <div class="form-group">
                            <label style="margin-right: 145px">Niveau : </label>
                            <input type="text" name="niveau">
                        </div>
                        {{-- ici commence la gestion de section et groupe --}}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="ml-3" style="margin-right: 10px">Ajouter des sections</p>
                                </div>
                                <div class="col-sm-6">
                                    <button type="button" onclick="ajouterSection()" class="custom-btn" title="Ajouter">+</button>
                                    <button type="button" onclick="supprimerSection()" class="custom-btn" title="Supprimer">X</button>

                                </div>
                            </div>
                            <div id="main-container">
                                <!-- Les sections seront ajoutées ici -->
                            </div>
                            {{-- <input type="submit" value="Soumettre"> --}}
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

            // Ajouter les champs de la première section
            ajouterSection();
        });

        // Ajoutez un écouteur d'événement pour détecter le clic sur le bouton de fermeture
        closeBtn.addEventListener('click', function() {
            // Cacher le modal
            resourceModal.style.display = 'none';
        });

        // Sélectionnez le bouton "Annuler"
        const btnAnnuler = document.getElementById('annuler');

        // Fonction pour ajouter une nouvelle section

        let sectionCount = 0; // Index initial pour les sections

        function ajouterSection() {
            const mainContainer = document.getElementById('main-container');

            const sectionDiv = document.createElement('div');
            sectionDiv.id = `section-${sectionCount}`;
            sectionDiv.innerHTML = `
            <input type="text" name="nomsection[]" placeholder="Nom de la section" style="margin-bottom: 10px">
            <div id="groupe-container-${sectionCount}">
                <input type="text" name="nomgroupe[${sectionCount}][]" placeholder="Nom du groupe" style="margin-right: 10px">
                <input type="number" name="nombre_etudiants[${sectionCount}][]" placeholder="Nombre d'étudiants" min="1">
            </div>
            <button type="button" onclick="ajouterGroupe(${sectionCount})" class="custom-btn">Ajouter un groupe</button>
            <button type="button" onclick="supprimerGroupe(${sectionCount})" class="custom-btn">Supprimer un groupe</button>
            <hr>
        `;
            mainContainer.appendChild(sectionDiv);
            sectionCount++;
        }
        function supprimerSection() {
            const mainContainer = document.getElementById('main-container');
            const sections = mainContainer.querySelectorAll('[id^="section-"]');
            if (sections.length > 0) {
                const lastSection = sections[sections.length - 1];
                mainContainer.removeChild(lastSection);
                sectionCount--; // Décrémentez le compteur de section
            }
        }


        function ajouterGroupe(sectionId) {
            const groupeContainer = document.getElementById(`groupe-container-${sectionId}`);
            const groupeDiv = document.createElement('div');
            groupeDiv.innerHTML = `
            <input type="text" name="nomgroupe[${sectionId}][]" placeholder="Nom du groupe">
            <input type="number" name="nombre_etudiants[${sectionId}][]" placeholder="Nombre d'étudiants" min="1">
        `;
            groupeContainer.appendChild(groupeDiv);
        }

        function supprimerGroupe(sectionId) {
            const groupeContainer = document.getElementById(`groupe-container-${sectionId}`);
            if (groupeContainer.children.length > 1) {
                groupeContainer.removeChild(groupeContainer.lastChild);
            }
        }
    </script>



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
    {{-- script pour la selection multiple --}}
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('countries')  // id
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
@endsection


