@extends('layouts.app')
@section('content')
<style>
     #essay{
            margin-left: 550px;
    margin-top: 10px;
    width: calc(100% - 250px);

    background-color: #FEF5E7;
        }
        #aj {
            width: 100%;
            padding: 10px;
            border: none;
            margin-right: 60px;
            border-radius: 5px;
            background-color: #35512f; /* Même couleur de fond que dans le deuxième code */

            cursor: pointer;
        }

</style>

<div class="content-wrapper" id="essay">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Ajouter un administrateur</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-17">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field()}}
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{ old('name')}}" name="name" required placeholder="Name">
                      </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" value="{{ old('email')}}"  name="email" required placeholder="Email">
                    <div style="color: red">{{ $errors->first('email')}}</div>
                  </div>
                  <div class="form-group">
                    <label >Password</label>
                    <input type="password" class="form-control"  name="password" required placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-dark" id="aj">
                        {{ __('Ajouter') }}
                    </button>
                </div>
              </form>
            </div>
          </div>


        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection
