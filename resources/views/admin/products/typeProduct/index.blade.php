@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')

@section('content_header')
    <h1>จัดการประเภทสินค้า</h1>
@stop

@section('content')

   <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-warning">
              <a href="{{ route('admin.TypeProducts.create') }}">
                <div class="card-header bg-success">
                  <h3 class="card-title"><span class="fa fa-cart-arrow-down"></span> เพิ่มรายการสินค้า</h3>
                </div>
              </a>    
            </div>
          </div>
        </div>
      </div>
  </section>
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">รายการประเภทสินค้า</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ลำดับ</th>
                  <th>รูป</th>
                  <th>ชื่อ</th>
                  <th>ราคาปลีก</th>
                  <th>ราคาส่ง</th>
                  <th>รายละเอียด</th>
                  <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>

                  @foreach ($products as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td> <!-- ลำดับ-->
                    <td>
                        <div style="width: 100px; height:100px ;">
                          <img src="{{ URL('storage/'.$item->image) }}" alt="{{$item->name}}" style="width: 100%; height:100% ;">
                        </div>  
                    </td><!-- รูป -->
                    <td>{{$item->name}}</td> <!-- ชื่อ -->
                    <td>{{number_format($item->retail,2)}} บาท</td>      <!-- ราคาปลีก -->
                    <td>{{number_format($item->wholesale,2)}} บาท</td>       <!-- ราคาส่ง -->
                    <td>
                      @if ($item->des)
                          {{$item->des}}
                      @else
                          รออัพเดท
                      @endif
                      
                    </td>       <!-- รายละเอียด -->
                    <td>
                      <div class="row">
                        {{-- <div class="col-12 col-sm-4"> --}}
                          <a  href="{{ route('admin.TypeProducts.edit', $item->id) }}">
                            <input type="button" class="btn btn-warning m-1" value="แก้ไข">
                          </a>
                        {{-- </div> --}}
                        {{-- <div class="col-12 col-sm-4"> --}}
                          <form action="{{ route('admin.TypeProducts.destroy', $item->id) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger m-1" value="ลบ">
                          </form>
                        {{-- </div> --}}
                       
                      </div>
                    </td>       <!-- จัดการ -->
                  </tr>
                 @endforeach

                </tbody>
                {{-- <tfoot>
                <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
                  <th>Engine version</th>
                  <th>CSS grade</th>
                </tr>
                </tfoot> --}}
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->

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
        $('#show-image').hide()
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
      