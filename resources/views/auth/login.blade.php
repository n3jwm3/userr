<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
   <link href="{{ asset('CSS/login.css') }}" rel="stylesheet">
  <style>
    #nij{
       background-color: #FEF5E7;
   }
   #ver{
   background-color:#35512f;
 }

    </style>
</head>
<body class="hold-transition login-page" id="nij">
<div class="login-container">
    <img src="/Images/ilage1.png" class="login-image" alt="Admin Image">
    <div class="login-box">


        <h1>Bienvenue dans votre site d’EDT d’examens</h1>
        <p>Authentifiez-vous pour accéder au site</p>
            @include('_message')
            <form action="{{ url('login')}}" method="post">
              {{ csrf_field()}}
              <div class="input-group mb-3">
                <input type="email" class="form-control" required name="email" placeholder="Email" autofocus>
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="login-btns ">
                  <button type="submit" class="login-btn">Se connecter</button>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember"  style="color:black">
                        se souvenir de moi
                    </label>
                  </div>
                </div>
                <div class="col-9">
                    <a href=" {{url('forgot-password')}}" style="color:black">J’ai oublié mon mot de passe</a>
                </div>
        </form>

    </div>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src=" {{ url('public/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script type = " {{ url('public/dist/js/adminlte.min.js')}} " ></script>
</body>
</html>

