@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ข้อมูลส่วนตัว</h1>
@stop

@section('content')
<div class="card card-widget widget-user">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-warning" >
      <h3 class="widget-user-username">{{ Auth::user()->name}}</h3>
      <h5 class="widget-user-desc">ตำแหน่ : {{ Auth::user()->adminlte_desc() }} {{ Auth::user()->user_branch() }}</h5>
    </div>
    <div class="widget-user-image">
      <img class="img-circle elevation-2" src="{{ Auth::user()->adminlte_image() }}" alt="User Avatar">
    </div>
    <div class="card-footer">
      <div class="row">
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header">3,200</h5>
            <span class="description-text">SALES</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4 border-right">
          <div class="description-block">
            <h5 class="description-header">13,000</h5>
            <span class="description-text">FOLLOWERS</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
        <div class="col-sm-4">
          <div class="description-block">
            <h5 class="description-header">35</h5>
            <span class="description-text">PRODUCTS</span>
          </div>
          <!-- /.description-block -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
  </div>
    {{-- <p>Welcome to this beautiful admin panel.</p>
    <p class=""> {{$usermane}}</p>
    <p class=""> {{$User_image}}</p>
    @if ($User_image == NULL)
        555555;jk'
    @endif --}}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop