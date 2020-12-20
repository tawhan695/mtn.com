@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content')
<section class="content">
  @error('productnull')
    <script>
      alert('สินค้าไม่มี');
    </script>
  @enderror
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title">เพิ่มสินค้าชำรุด</h3>
          </div>
          <!-- /.card-header -->
         <form action="{{ route('admin.DefectiveProducts.store') }}" method="post">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <!-- select -->
                <div class="form-group">
                  <label>ประเภทสินค้า</label>
                  <select class="form-control" name="product_id">
                    @foreach ($products as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                    
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>จำนวนสินค้าชำรุด (แผง)</label>
                  <input type="number" step="1" name="qty" class="form-control" placeholder="จำนวน">
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <button type="submit" class="btn btn-info btn-block" >บันทึกข้อมูล</button>
                </div>
              </div>
            </div>
          </div>
         </form>
          <!-- /.card-body -->
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
                <h3 class="card-title">รายการประเภทสินค้าชำรุด</h3>
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
                    <th>จำนวน</th>
                    {{-- <th>รายละเอียด</th> --}}
                    {{-- <th>จัดการ</th> --}}
                  </tr>
                  </thead>
                  <tbody>
    
                    @foreach ($DefectiveProducts as $item)
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
                        @if ($item->qty == 0)
                          <span class="badge badge-danger">สินค้าหมด</span>
                        @else
                        {{number_format($item->qty)}} แผง
                            
                        @endif  
                      </td>       <!-- ราคาส่ง -->
                      {{-- <td>
                        @if ($item->des)
                            {{$item->des}}
                        @else
                            รออัพเดท
                        @endif
                        
                      </td>       <!-- รายละเอียด --> --}}
                     <!-- <td>
                        <div class="row">
                          {{-- <div class="col-12 col-sm-4"> --}}
                            {{-- <a  href="{{ route('admin.TypeProducts.edit', $item->id) }}">
                              <input type="button" class="btn btn-warning m-1" value="แก้ไข">
                            </a> --}}
                          {{-- </div> --}}
                          {{-- <div class="col-12 col-sm-4"> --}}
                            <form action="{{ route('admin.TypeProducts.destroy', $item->id) }}" method="POST">
                              @csrf
                              {{ method_field('DELETE') }}
                              <input type="submit" class="btn btn-danger m-1" value="ลบ">
                            </form>
                          {{-- </div> --}}
                         
                        </div>
                      </td>       
                    </tr> -->
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
      