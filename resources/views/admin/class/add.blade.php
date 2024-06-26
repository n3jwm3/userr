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
<div class="content-wrapper" id="essay">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add new Class</h1>
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
                        <label>Class Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Name">
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                      </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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
