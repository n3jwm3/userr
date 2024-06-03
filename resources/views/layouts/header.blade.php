  <!-- Navbar -->
  <style>
     #nij{
        background-color: #FEF5E7;

    }
    #ver{
    background-color:#35512f;
    border-top-left-radius: 0px;
    border-top-right-radius: 30px;
    border-bottom-right-radius: 30px;
    margin-top: 10px;
  }
  #texte{

    color: #FEF5E7
  }
  #texte:hover {
        background-color:#FEF5E7;
        color: #000;

  }

  </style>

  <nav class="main-header navbar navbar-expand navbar-white navbar-light" id="nij">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="user-panel" >
            <img src="{{ asset('assets/homme.png')}}" class="img-circle elevation-1" alt="User Image">

            <a href="#" style="color: #000">{{ Auth::user()->name}}</a>
            {{-- <a href="{{ url('admin/teacher/' . Auth::user()->id) }}" style="color: #000">{{ Auth::user()->name }}</a>
--}}
          </a>
        </li>
      </ul>
  </nav>

 <aside class="main-sidebar sidebar-primary elevation-4" id="ver" >
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link" style="text-align: center">

      <span class="brand-text font-weight-light">
        <img src="{{ asset('dist/img/menu.png')}}"  alt="User Image"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" id="ver">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (Auth::user()->user_type == 1)
            <li class="nav-item" id="texte">
                <a href="{{url('admin/dashbaord')}} " class="nav-link "  id="texte">
                    <i class="fas fa-home"></i>
                  <p >
                    Accueil
                  </p>
                </a>
              </li>
{{--  specialite--}}
              <li class="nav-item" id="texte">
                <a href="{{url('admin/specialites/list')}}" class="nav-link"   id="texte">
                    <i class="fas fa-graduation-cap"></i>
                  <p>
                    Spécialités
                  </p>
                </a>
              </li>
              {{-- enseignnats ----}}
              <li class="nav-item" id="texte">
                <a href="{{url('admin/teacher/list')}}" class="nav-link " id="texte">
                    <i class="fas fa-chalkboard-teacher"></i>
                  <p>
                    Enseignants
                  </p>
                </a>
              </li>
              <li class="nav-item" id="texte">
                <a href="{{url('/Modules/module')}}" class="nav-link" id="texte">
                    <i class="fas fa-book"></i>
                  <p>
                    Modules
                  </p>
                </a>
              </li>
{{-- locaux--}}
              <li class="nav-item" id="texte">
                <a href="{{ route('local.index') }}" class="nav-link" id="texte">
                    <i class="fas fa-building"></i>
                  <p>
                    Locaux
                  </p>
                </a>
              </li>
              {{--emploi de temps--}}
              <li class="nav-item" id="texte">
                <a href="{{ route('GestionPlanning') }}" class="nav-link" id="texte">
                    <i class="fas fa-calendar-alt"></i>
                  <p>
                    Emplois du temps
                  </p>
                </a>
              </li>

              <li class="nav-item" id="texte">
                <a href="{{url('admin/admin/list')}}" class="nav-link" id="texte">
                  <i class="nav-icon far fa-user"></i>
                  <p>
                    Admin
                  </p>
                </a>
              </li>

              @elseif(Auth::user()->user_type == 2)
              <li class="nav-item" id="texte">
                <a href="{{url('teacher/dashbaord')}}" class="nav-link" id="texte">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Accueil
                  </p>
                </a>
              </li>
              <li class="nav-item" id="texte">
                <a href="{{url('teacher/disponibilite/list')}}" class="nav-link" id="texte">
                    <i class="nav-icon fas fa-building"></i>
                  <p>
                    Disponibilite
                  </p>
                </a>
              </li>

            @endif
            <li class="nav-item" id="texte">
                <a href="{{url('logout')}}" class="nav-link" id="texte">
                    <i class="fas fa-sign-out-alt" ></i>
                  <p>
                    Se déconnecter
                  </p>
                </a>
              </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

