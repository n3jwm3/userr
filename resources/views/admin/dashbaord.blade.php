@extends('layouts.app')
@section('content')
<style>
    #nij{
        background-color: #FEF5E7;
    }
    .bloc img {
    width: 60px;
    height: 55px;


}
#im{
    background-color: #fff;
}
#ml{
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
                <div class="small-box"  id="im">
                            {{--<img src="{{ asset('Images/specialite-removebg-preview.png') }}" alt="Description de l'image" >--}}
                            <div class="icon">
                                <i class="fas fa-chalkboard-teacher" style="color:#35512f;"></i>
                              </div>
                  <div class="inner">
                    <h3>{{\App\Models\User::where('user_type', 2)->count()}}</h3>
                    <p>Enseignants</p>
                  </div>
                  <div class="small-box-footer"> Enseignants</div>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box"  id="im">
                  <div class="inner">
                    <h3>{{\App\Models\specialite::count()}}</h3>
                    <p>Spécialités</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-graduation-cap" style="color:#35512f;"></i>
                  </div>
                  <div class="small-box-footer">Spécialités</div>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box"  id="im">
                  <div class="inner">
                    <h3>{{\App\Models\Local::count()}}</h3>
                    <p> Locaux</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-building" style="color:#35512f;"></i>
                  </div>
                  <div class="small-box-footer"> Locaux </div>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box"  id="im">
                  <div class="inner">
                    <h3>{{\App\Models\Groupe::sum('nombre_etudiant')}}</h3>

                    <p>Etudiants</p>
                  </div>
                    <div class="icon">
                    <i class="ion ion-person" style="color:#35512f;"></i>
                   {{--  <div class="bloc"><img src="{{ asset('Images/specialite-removebg-preview.png') }}" alt="Description de l'image" ></div>--}}
                      </div>
                  <div class="small-box-footer">Etudiants</div>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div></div>
@endsection
