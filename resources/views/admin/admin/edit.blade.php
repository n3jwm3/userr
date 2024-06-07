@extends('layouts.app')
@section('title', ' Administrateurs')
@section('content')
<style>

    #essay{
            margin-left: 450px;
            margin-top: 10px;
           width: calc(100% - 250px);

         background-color: #FEF5E7;
        }
        #buttmod {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
            cursor: pointer;
            background-color: #35512f;
            color: #fff;
            border: none;
            padding: 10px;
            margin-left: 0;
        }

        #buttmod:hover {
            background-color: #35dc3b;
            border-color: #35dc3b;
        }

        #buttmod:active {
            background-color: #35dc49;
            border-color: #35dc49;
        }
</style>
<div class="content-wrapper" id="essay">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modification administrateur</h1>
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
                        <label>Nom</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name',$getRecord->name) }}" required placeholder="Name">
                      </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email',$getRecord->email) }}" required placeholder="Email">
                    <div style="color: red">{{ $errors->first('email')}}</div>
                  </div>
                  <div class="form-group">
                    <label >Mot de passe</label>
                    <input type="text" class="form-control"  name="password"  placeholder="Password">
                    <p>Si vous souhaitez modifier le mot de passe, veuillez en ajouter un nouveau</p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="col-md-8 offset-md-2">
                        <button type="submit" class="btn btn-dark" id="buttmod">{{ __('  Modification') }}</button>
                    </div>
                </div>
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
