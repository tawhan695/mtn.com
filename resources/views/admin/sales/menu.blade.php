@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')

@section('content_header')
    
@stop

@section('content')

<div class="row ">
  <div class="col-12 col-sm-6 m50 ">
    <a href="{{route('admin.saler.show',1)}}">
      <div class="card bg-primary text-white ">
        <div class="card-body text-center f-100">ขายปลีก</div>
      </div>
    </a>
  </div>
  <div class="col-12 col-sm-6 m50 ">
  <a href="{{route('admin.saler.show',2)}}">
    <div class="card bg-success text-white ">
      <div class="card-body text-center f-100 ">ขายส่ง</div>
    </div>
   </a>
  </div>
</div>

<style>
  .box{
    height: 300px;
        margin-top: auto;
    margin-bottom: auto;
  }
  .f-100{
    font-size: 50px;
    
  }
  .m50{
   padding: 5% 5% 5% 5%;
  }
</style>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
      <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}"> --}}
  
@stop

@section('js')  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
      $(function () {
        
        $("#example1").DataTable({
          "responsive": true,
          "autoWidth": false,
        });
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
     
        

      

      });
    </script>
    <!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


@stop