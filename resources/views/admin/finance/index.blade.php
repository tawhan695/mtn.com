@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')

@section('content_header')
    <h1>การเงิน</h1>
@stop

@section('content')
@error('nullwallet')
<script>
  alert('เงินทอนไม่พอ');
</script>
@enderror
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-wallet"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">เงินสด</span>
            <span class="info-box-number">
              {{number_format($finance,2)}}
              
              <small>บาท</small>
              @can('Manager-product')
                
                <button class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalCenter">เพิ่มเงินสด</button>
              @endcan
              <!-- Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <form class="form-horizontal" action="{{ route('admin.finance.update',session()->get('branch')) }}"  method="POST">
                      @csrf
                      @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มยอดเงิน</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input step="2"  min="0"  type="number" name="price_update" id="" class="form-control form-control-lg"  placeholder="เพิ่มจำนวนเงิน">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    </form>

                  </div>
                </div>
              </div>
              <!-- Modal -->
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ยอดขาย  วันนี้</span>
            <span class="info-box-number">
              @php
              $tatol = 0 ;
              foreach ($qty as $key => $value) {
                  $tatol  += $value->qty;
              } 
              echo $tatol;
           @endphp

              <small>แผง</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">รายได้ วันนี้</span>
            <span class="info-box-number">
            
             @php
                $tatol = 0 ;
                foreach ($tatol_price as $key => $value) {
                    $tatol  += $value->Total_price;
                } 
                echo $tatol;
             @endphp
              <small>บาท</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      {{-- <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-balance-scale-left"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">กำไร วันนี้</span>
            <span class="info-box-number">
              2,000
              <small>บาท</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div> --}}
      <!-- /.col -->

      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">ยอดขาย  ทั้งหมด</span>
            <span class="info-box-number">
              @php
                $tatol = 0 ;
                

                foreach ($total_qty as $key => $value) {
                    $tatol  += $value->qty;
                } 
                echo $tatol;
              @endphp

              <small>แผง</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">รายได้ ทั้งหมด</span>
            <span class="info-box-number">
              @php
                $tatol = 0 ;
                foreach ($tatol_p as $key => $value) {
                    $tatol  += $value->Total_price;
                } 
                echo $tatol;
             @endphp
              <small>บาท</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      {{-- <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-balance-scale-left"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">กำไร วันนี้</span>
            <span class="info-box-number">
              2,000
              <small>บาท</small>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div> --}}
    
    </div>
    <!-- /.row -->
    </div>
    <!-- /.row -->
  </div><!--/. container-fluid -->
</section>
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
    <!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@stop
      