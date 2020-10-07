@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')

@section('content_header')
    <h1>ประวัติการขาย</h1>
@stop

@section('content')
 
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
                  <th>เลขที่ใบเสร็จ</th>
                  <th>ชื่อพนักงานขาย</th>
                  <th>ยอดสั่งชื่อ</th>
                  {{-- <th>ราคาขาย</th> --}}
                  <th>ราคารวม</th>
                  <th>date</th>
                  <th>จัดการ</th>
                </tr>
                </thead>
                <tbody>
               @foreach ($oder as $item)
                <tr>
                  <td>{{$item->id}}</td> <!-- ลำดับ-->
                  <td>
                   @php
                       echo App\User::find($item->user_id)->name;
                   @endphp
                  </td><!-- รูป -->
                  <td>
                      @php
                      $qty = 0;
                          $list = App\order_list::where('salers_id',$item->id)->get();
                          foreach ($list as $key => $value) {
                            $qty += $value->qty;
                          }
                          echo $qty;
                      @endphp
                      
                  </td>      
                  
                      
                  <td>{{number_format($item->Total_price,2)}}</td>      <!-- ราคาปลีก -->
                  <td>{{$item->created_at}}</td> 
                  <td>
                    <div class="row">
                       
                          {{-- <input type="button" class="btn btn-warning m-1" value="เพิ่มเติม"> --}}
                          <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#ModalLong{{$item->id}}">
                            แสดงเพิ่มเติม
                          </button>
                        {{-- <form action="" method="POST">
                          @csrf
                          {{ method_field('DELETE') }}
                          <input type="submit" class="btn btn-danger m-1" value="ลบ">
                        </form> --}}
                    </div>
                  </td>       <!-- จัดการ -->
                </tr>

                  <!-- Button trigger modal -->


          

                @endforeach

                </tbody>
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
      <!-- Modal -->
      @foreach ($oder as $item)
      <div >

      <div class="modal fade" id="ModalLong{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">ใบเสร็จ     (มัทนาไข่สด)</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="printThis{{$item->id}}">
               <table  class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ชื่อสินค้า</th>
                      <th>จำนวนสินค้า</th>
                      <th>ราคา</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $list = App\order_list::where('salers_id',$item->id)->get();
                    @endphp
                    @foreach ($list as $key => $value)
                    <tr>
                          
                      
                      <td>{{$loop->iteration}}</td>
                      <td>
                        {{ App\products::find($value->products_id)->name}}
                      </td>
                      <td>
                        {{$value->qty}}
                        
                      </td>
                      <td>{{$value->price}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                  <br>
                  <tfoot>
                    <tr>
                      <td>ทั้งหมด</td>
                      <td>{{$item->total}}</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ส่วนลด</td>
                      <td>{{$item->discount}}</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>เงินสด</td>
                      <td>{{$item->cash}}</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>เงินทอน</td>
                      <td>{{$item->change}}</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ราคาสุทธิ์</td>
                      <td>{{$item->Total_price}}</td>
                      <td>บาท</td>
                    </tr>
                  </tfoot>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button id="btnPrint{{$item->id}}" type="button" class="btn btn-default">Print</button>
            </div>
          </div>
        </div>
      </div>
      <style>
            @media screen {
              #printSection{{$item->id}} {
                  display: none;
              }
            }

            @media print {
              body * {
                visibility:hidden;
              }
              #printSection{{$item->id}}, #printSection{{$item->id}} * {
                visibility:visible;
              }
              #printSection{{$item->id}} {
                position:absolute;
                left:0;
                top:0;
              }
            }
      </style>
      <script>
            document.getElementById("btnPrint{{$item->id}}").onclick = function () {
                printElement(document.getElementById("printThis{{$item->id}}"));
            }

            function printElement(elem) {
                var domClone = elem.cloneNode(true);
                
                var $printSection = document.getElementById("printSection{{$item->id}}");
                
                if (!$printSection) {
                    var $printSection = document.createElement("div");
                    $printSection.id = "printSection{{$item->id}}";
                    document.body.appendChild($printSection);
                }
                
                $printSection.innerHTML = "";
                $printSection.appendChild(domClone);
                window.print();
            }
      </script>
      
      </div>
      @endforeach
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
      