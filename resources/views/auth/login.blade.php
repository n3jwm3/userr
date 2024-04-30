<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  {{--<link rel="stylesheet" href=" {{ url('public/plugins/fontawesome-free/css/all.min.css')}}">--}}
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  {{--<link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">--}}
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  {{--<link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css')}}">--}}
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
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
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline " id="ver">
    <div class="card-header text-center">
      <a href="" class="h1" style="color:black"><b>Login</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
@include('_message')
      <form action="{{ url('login')}}" method="post">
        {{ csrf_field()}}
        <div class="input-group mb-3">
          <input type="email" class="form-control" required name="email" placeholder="Email">
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
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember" style="color:black">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-block" id="nij">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>


      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href=" {{url('forgot-password')}}" style="color:black">I forgot my password</a>
      </p>
    </div>

  </div>

</div>


<!-- jQuery -->
<script src=" {{ url('public/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ url('public/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script type = " {{ url('public/dist/js/adminlte.min.js')}} " ></script>
</body>
</html>
