@extends('adminlte::page')

@section('title', 'Dashboard')

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
              <h3 class="card-title">รายการโอนเข้า</h3>
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
                  <th>จำนวน (แผง)</th>
                  <th>ส่งจาก</th>
                  <th>วันที่ส่ง</th>
                  @can('import')
                    <th>จัดการ</th>
                    
                  @endcan
                </tr>
                </thead>
                <tbody>
  
                  @foreach ($products_im as $item)
                  <tr>
                    <td>{{$loop->iteration}}</td> <!-- ลำดับ-->
                    <td>
                        <div style="width: 50px; height:50px ;">
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
                      {{number_format($item->qty)}}
                          
                      @endif  
                    </td>       <!-- ราคาส่ง -->
                    <td>
                      <span class="badge badge-primary">{{$item->form}}</span>
                    </td>       <!-- รายละเอียด -->
                    <td>
                      {{$item->created_at}}
                    </td>       <!-- รายละเอียด -->
                    @can('import')
                    <td>
                      <div class="row">
                          <form action="{{ route('admin.ImportProducts.update',[$item->id,'qty'=>$item->qty]) }}" method="POST">
                            @csrf
                            {{ method_field('PUT') }}
                            <input type="submit" class="btn btn-info m-1" value="รับเข้าคลังสินค้า">
                          </form>
                        {{-- </div> --}}
                       
                      </div>
                    </td>       <!-- จัดการ -->
                    @endcan
                    
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
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
    
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">เพิ่มสินค้า</h3>
              </div>
              <!-- /.card-header -->
             <form action="{{ route('admin.ImportProducts.store') }}" method="post">
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
                      <label>จำนวน (แผง)</label>
                      <input type="number" step="1" name="qty" class="form-control" placeholder="จำนวน">
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-info btn-block" >เพิ่มข้อมูล</button>
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
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">ประวัติการรับสินค้า</h3>
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
                    <th>จำนวน (แผง)</th>
                    <th>ส่งจาก</th>
                    <th>วันที่ส่ง</th>
                    <th>วันที่รับ</th>
                    @can('Manager')
                      <th>จัดการ</th>
                      
                    @endcan
                  </tr>
                  </thead>
                  <tbody>
    
                    @foreach ($import as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td> <!-- ลำดับ-->
                      <td>
                          <div style="width: 50px; height:50px ;">
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
                        {{number_format($item->qty)}}
                            
                        @endif  
                      </td>       <!-- ราคาส่ง -->
                      <td>
                        <span class="badge badge-primary">{{$item->form}}</span>
                      </td>
                      <td>
                        {{$item->sent_date}}
                      </td>       <!-- รายละเอียด -->
                      <td>
                        {{$item->created_at}}
                      </td>       <!-- รายละเอียด -->
                      @can('Manager')
                      <td>
                        <div class="row">
                          {{-- <div class="col-12 col-sm-4"> --}}
                            <a  href="{{ route('admin.ImportProducts.edit', $item->id) }}">
                              <input type="button" class="btn btn-warning m-1" value="แก้ไข">
                            </a>
                          {{-- </div> --}}
                          {{-- <div class="col-12 col-sm-4"> --}}
                            <form action="{{ route('admin.ImportProducts.destroy', $item->id) }}" method="POST">
                              @csrf
                              {{ method_field('DELETE') }}
                              <input type="submit" class="btn btn-danger m-1" value="ลบ">
                            </form>
                          {{-- </div> --}}
                         
                        </div>
                      </td>       <!-- จัดการ -->
                      @endcan
                      
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
      