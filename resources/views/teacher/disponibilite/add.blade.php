@extends('layouts.app')
@section('content')
<style>
      #essay{
            margin-left: 250px;
    margin-top: 10px;
    width: calc(100% - 250px);

    background-color: #FEF5E7;
        }
</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
              crossorigin="anonymous">
              <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
<div class="content-wrapper" id="essay">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new Dispo</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <form method="post" action="">
                {{ csrf_field()}}
                <div class="card-body">
                    <div class="form-group">
                        <label>jour Choisissez les crenaux</label>
                        

                        <input type="date" class="form-control" name="jour" required placeholder="jour">
                      </div>
                      <div class="form-group">
                <h5 class="text-white"> </h5>

             </div>
 <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.0.1/dist/js/multi-select-tag.js"></script>
             <script>
               new MultiSelectTag('crenaux')  // id
              </script>
                </div>
                <!-- /.card-body -->
                     <div class="btnajt d-flex justify-content-center">
                     <div class="col-md-8">
                         <button type="submit" class="btn" style="background-color: white; color: black; text">
                             {{ __('Ajouter') }}
                         </button>
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
