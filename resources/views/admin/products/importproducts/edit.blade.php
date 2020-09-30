@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')

@section('content_header')
    <h1></h1>
@stop

@section('content')
   <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">แก้ไขรายการสินค้า</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form" enctype="multipart/form-data" method="POST" action="{{ route('admin.ImportProducts.update',$product) }}">
                  @csrf
                  @method('PUT')
                  <div class="row">
                    {{-- <div class="col-sm-12">
                      <div class="form-group">
                        <label for="text" class="col-md-4 col-form-label text-md-right"></label>
                        <div class="col-md-6 " id="show-image" style="hieght:100%; width:100%" align="center">
                            <img id="blah" 
                                class="img-fluid shadow-lg p-2 m-2 bg-white rounded mx-auto d-block " src="{{ URL('storage/'.$product->image) }}" alt="{{$product->name}}">
                        </div>
                    </div>
                    </div> --}}
                    {{-- <div class="col-sm-12">
                      <div class="form-group">
                        <label for="exampleFormControlFile1">เพิ่มภาพแก้ไข</label>
                        <input name="image" id="imgInp" type="file" class="form-control-file"  accept="image/png, image/jpeg">
                      </div>
                    </div> --}}
                    
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label>ชื่อสินค้า</label>
                          <input type="text" name="name" value="{{$product->name}}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter ..." required>
                        @error('name')
                        <p class="text-danger">กรุณาใส่ข้อมุลให้ถูกต้อง {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>จำนวนแผง</label>
                        <input type="number"  step="1" name="qty" value="{{$product->qty}}" class="form-control @error('qty') is-invalid @enderror" placeholder="Enter .."  required>
                        @error('qty')
                        <p class="text-danger">กรุณาใส่ข้อมุลให้ถูกต้อง {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>จากสาขา</label>
                        <select class="form-control" name="form">
                          @foreach ($Branch as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                          @endforeach
                          
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>ราคาขายปลีก</label>
                        <input type="number"  step="0.01" name="retail" value="{{$product->retail}}" class="form-control @error('retail') is-invalid @enderror" placeholder="Enter 00.00"  required>
                        @error('retail')
                        <p class="text-danger">กรุณาใส่ข้อมุลให้ถูกต้อง {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label>ราคาขายส่ง</label>
                        <input type="number"  step="0.01" name="wholesale" value="{{$product->wholesale}}" class="form-control @error('wholesale') is-invalid @enderror" placeholder="Enter 00.00" required>
                        @error('wholesale')
                        <p class="text-danger">กรุณาใส่ข้อมุลให้ถูกต้อง {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>รายละเอียดสินค้า</label>
                        <textarea name="des" class="form-control @error('des') is-invalid @enderror" rows="3" placeholder="Enter ...">{{$product->des}}</textarea>
                        @error('des')
                        <p class="text-danger">กรุณาใส่ข้อมุลให้ถูกต้อง {{ $message }} </p>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="submit" value="บันทึกการเปลี่ยนแปลง" class="btn btn-warning btn-block">
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
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
    <script>
        // $('#show-image').hide()
   $(document).ready(function () {
        function del_video(id) {
            // $(id).remove();

        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

        $(document).ready(function () {
            // show img
            $('#imgInp').on('change', prepareUpload);

            function prepareUpload(event) {
                files = event.target.files[0];
                $('#InputFileName').text(files.name);
                $('#show-image').show()
            };
        });


    });
    </script>
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
      