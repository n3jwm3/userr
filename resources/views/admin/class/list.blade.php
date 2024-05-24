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
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper" id="essay">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Class List</h1>
          </div>
          <div class="col-sm-6" style="text-align: right ; ">
                <a href="{{ url('admin/class/add')}}" class="btn btn-primary">Add new Class</a>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            @include('_message')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Class list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th >#</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th >Created_by</th>
                      <th >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($getRecord as $value )
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>
                            @if($value->status == 0 )
                             Active
                            @else
                             Inactive
                            @endif
                             </td>
                        <td>{{ $value->created_by}}</td>
                        <td class="d-flex justify-content-center align-items-center">
                           {{-- <a href="{{ url('admin/admin/edit/'.$value->id)}}" class="btn btn-sm btn-warning mx-2">
                                <i class="fas fa-edit"></i></a>
                            <form id="{{$value->id}}" action="{{route('dest',$value->id)}}" method="post">
                                @csrf
                                @method("DELETE")

                            <button onclick="deleteAd({{$value->id}})"
                                type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button> </form>--}}
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
