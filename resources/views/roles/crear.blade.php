@extends('layouts.app')
@section('title','Crear')
@section('script-top')
    @parent
@endsection
@section('script-bottom')
    @parent
@endsection
@section('style')
    @parent
@endsection
@section('navbar')
    @include('include.navbar')
@endsection
@section('sidebar')
    @include('include.sidebar')
@endsection
@section('footer')
    @include('include.footer')
@endsection
@section('content')
<div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Nuevo Role</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @elseif(session('admin'))
                <div class="alert alert-info" role="alert">
                    <li>{{session('admin')}}</li>
                </div>
                @endif
              <div class="card-header">
                <h3 class="card-title">Crear Nuevo</h3>

                <div class="card-tools">

                </div>
              </div>
              <div class="card-body">
                {!! Form::open(['route'=>['roles.store'],'method'=>'post', 'autocomplete' =>'off']) !!}
                {!! Form::token() !!}
                <div class="row">
                    <div class="col-md-3">
                    {!! Form::label('nombre', 'Nombre', ['class'=>'badge-primary']) !!}
                    {!! Form::text('nombre', old('nombre'), ['class'=>'form-control']) !!}<br>
                    </div>
                </div>
                {!! Form::submit('Registrar', ['class'=>'btn btn-success']) !!}
                {!!link_to('home','Regresar',['class'=>'btn btn-success'])!!}
                {!! Form::close() !!}
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Laravel 5.8.*
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

</div>
@endsection
