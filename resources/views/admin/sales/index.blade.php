@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')
@section('head')
 
@endsection
@section('content_header')
    <h1>การขาย 
      @php
      $s = '';
          if($type == 1){
            $s = 'ปลีก';
            echo $s;
          }else{
            $s = 'ส่ง';
            echo $s;
          }
      @endphp
    </h1>
@stop

@section('content')

<div class="row">
  <div class="col-lg-7">

    
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
                <th>ชื่อ</th>
                <th>ราคา{{$s}}</th>
                <th>จำนวนในคลัง</th>
        
                <th>จัดการ</th>
              </tr>
              </thead>
              <tbody>

                @foreach ($products as $item)
                <tr>
                  <td>{{$loop->iteration}}</td> <!-- ลำดับ-->
                  <td>{{$item->name}}</td> <!-- ชื่อ -->
                  <td >@if ($type == 1)
                    {{number_format($item->retail,2)}}
                  @else
                    {{number_format($item->wholesale,2)}}
                  @endif บาท</td>
                  <td id="qtyp{{$item->id}}">
                    @if ($item->qty == 0)
                      <span class="badge badge-danger">สินค้าหมด</span>

                    @else
                    {{$item->qty}}
                        
                    @endif  
                  </td>       <!-- ราคาส่ง -->
                  
                  <td>
                    <div class="row">
                      {{-- <div class="col-12 col-sm-4"> --}}
                        @if ($item->qty != 0)
                        <button id="addp" type="button" class="btn btn-warning m-1" onclick="addProduct({{$item->id}},{{$type}});" ><span  class="fas fa-cart-plus"  ></span> เพิ่มใส่ตะกร้า</button>
                        @else
                        <button disabled type="button" class="btn btn-warning m-1" onclick="addProduct({{$item->id}},{{$type}});" ><span  class="fas fa-cart-plus"  ></span> เพิ่มใส่ตะกร้า</button>

                        @endif 
                    </div>
                  </td>       <!-- จัดการ -->
                </tr>
               @endforeach

              </tbody>
  
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
  </div>
  <div class="col-lg-5 ">
    <div class="card ">
      <div class="card-header bg-info ">
        <h3 class="card-title">ตะกร้าสินค้า</h3>
      </div>
      <!-- /.card-header -->
      <form action="{{route('admin.salers.store')}}" method="post">
        @csrf
        @method('POST')

        <div class="card-body p-0 ">
          <table id="example44" class="table table-striped">
            <thead>
              <tr>
                <th style="width: 10px">รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>จำนวน</th>
                <th style="width: 40px">ราคา</th>
              </tr>
            </thead>
            <tbody id="stock">
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td>
                  รวม
                </td>
                <td>
                  {{-- <span style="font-size: 100%" class="badge bg-primary " id="priceSum">0</span> --}}
                  <input  class="input" type="number" id="priceSum" name="priceSum" value="0">    
                </td>
                <td>บาท</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  ส่วนลด
                </td>
                <td>
                  <input class="input" step="0" min="0" type="number"  id="discount2" name="discount2" value="0">    
                  
                </td>
                <td>บาท</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  รวมทั้งหมด
                </td>
                <td>
                  {{-- <span style="font-size: 100%" class="badge bg-primary " id="priceall">0</span>     --}}
                  <input  class="input" type="number" name="priceall" id="priceall" value="0">
                </td>
                <td>บาท</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  รับเงินสด
                </td>
                <td>
                  <input  class="input"  step="0" min="0" type="number" name="cash" id="cash" value="0">   
                  <p class="text-danger">
                    @error('error_change')
                      กรุณาใส่จำนวนเงินที่ต้องจ่าย
                    @enderror
                  </p> 
                </td>
                <td>บาท</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  เงินทอน
                </td>
                <td >
                  {{-- <span style="font-size: 100%" class="badge badge-pill badge-success" id="change">0.00</span>    --}}
                  <input  class="input" type="number" name="change" id="change">
                </td>
                <td>บาท</td>
              </tr>
              <tr>
                <td></td>
                <td>
                  เวลาทำการ
                </td>
                <td >
                  <span class="badge badge-pill badge-success">{{now()}}</span> 
                </td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td ></td>
                <td></td>
              </tr>
            </tfoot>
          </table>
          
          <button class="float-right btn btn-info m-3">จบการขาย</button>
        </div>
      </form>
      <!-- /.card-body -->
    </div>
  </div>
</div>

<script>
      var state = 0
      var price = 0
      // $.ajaxSetup({
      //   headers: {
      //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      //   }
      //   });
     function addProduct(ID_product,s){
       if (state == 0){
            state = s
       }

        console.log('id : ',ID_product);
        console.log('status : ',s);
          $.ajax({

            type:'POST',
            url:"{{URL('admin/saler')}}",
            data:{
            _token: "{{ csrf_token() }}",
            id:ID_product
           },

            success:function(data){
              if (parseInt($('#qtyp'+data.id).text()) <= 0 ){
                alert('สินค้าหมด')
              }else{
              if (state == 1) {
               price =  data.retail
              }else if(state == 2){
                price =  data.wholesale
              }

              var sum = 0;
              if ($('#price'+data.id).text() != 0){
                sum = $('#price'+data.id).text();
                sum= parseInt(sum)+price;
               
               var psum =  $('#priceSum').val();
               $('#priceSum').val(parseInt(psum)+price);
               $('#priceall').val((parseInt(psum)+price)-parseInt($('#discount2').val()));
               var Qt = parseInt($('#qtyp'+data.id).text())-1;
               $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()))
                $('#qtyp'+data.id).text(Qt);
              }else{
                sum = price;
                var psum =  $('#priceSum').val();
               $('#priceSum').val(parseInt(psum)+price);
               $('#priceall').val((parseInt(psum)+price)-parseInt($('#discount2').val()));
               $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()));
               var Qt = parseInt($('#qtyp'+data.id).text())-1;
                $('#qtyp'+data.id).text(Qt);
                
              }
              console.log('sum',sum);
              
              console.log('sum',sum);
              
              console.log($("#stock").prop("id"));
              if($("#tr"+data.id).prop("id")){
                var qty = parseInt($('#QTY'+data.id).val());
                qty += 1;
                $('#QTY'+data.id).val(qty);
              }else{
              

              
              $('#stock').append(
                '<tr id="tr'+data.id+'">'+
               ' <td>'+data.id+'</td>'+
             ' <td>'+data.name+'</td>'+
              '<td><div class="input-group mb-3"><div class="input-group-prepend">'+
                    '<button id="delQTY'+data.id+'"  onclick="delQTY('+data.id+')"style="border: 0" class="btn btn-outline-secondary" type="button"><span class="fa fa-minus-circle"></span></button>'+
                 ' </div><input  step="0" min="0" en type="number" name="qty[]" id="QTY'+data.id+'" value="1" class="form-control text-center" placeholder="" aria-label="" aria-describedby="basic-addon1">'+
                   '<div class="input-group-prepend"><button id="addQTY'+data.id+'" onclick="addQTY('+data.id+')" style="border: 0" class="btn btn-outline-secondary" type="button"><span class="fa fa-plus-circle"></span></button></div></div>'+
              '</td><td><span class="badge bg-success" id="price'+data.id+'">'+sum+'</span></td></tr>'+
              '<input type="hidden" name="id[]" value="'+data.id+'">' +
              '<input type="hidden" name="price_pro[]" value="'+sum+'">' 
                );
               
              
              }

            }
            }
          });
        }
     
        function addQTY(id){
          if (parseInt($('#qtyp'+id).text()) <= 0 ){
                alert('สินค้าหมด')
              }else{
          console.log(id);
          var qty = parseInt($('#QTY'+id).val());
          qty += 1;
          var Qt = parseInt($('#qtyp'+id).text())-1;
          $('#qtyp'+id).text(Qt);
          console.log('Qt',Qt);

          $('#QTY'+id).val(qty);
          var sss = parseInt($('#priceSum').val())+parseInt($('#price'+id).text());
          $('#priceSum').val(sss);
          $('#priceall').val(sss-parseInt($('#discount2').val()));
          $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()));
          console.log(qty += 1)
        }
        }
        function delQTY(id){
          
          console.log(id);
          var qty = parseInt($('#QTY'+id).val());
          var sss = parseInt($('#priceSum').val())-parseInt($('#price'+id).text());
          $('#priceSum').val(sss);
          $('#priceall').val(sss-parseInt($('#discount2').val()));
          $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()))
          if(qty == 0){

            qty = 0;
            $('#tr'+id).remove();
          }else{
            qty -= 1;
          }
          $('#QTY'+id).val(qty);
          if (qty <= 0){
            $('#tr'+id).remove();
          }
          var Qt = parseInt($('#qtyp'+id).text())+1;
          $('#qtyp'+id).text(Qt);
          console.log(qty += 1)
      }



</script>



<style>
  .input{
    width: 50%;
    /* height: 30px; */
    /* border-radius: 40px; */
    text-align: center;
    font-size: 100%
  }
  #inputprice{
    width: 50%;
    /* height: 30px; */
    /* border-radius: 40px; */
    text-align: center;
    font-size: 100%
  }
  #input2{
    width: 80px;
    /* height: 30px; */
    /* border-radius: 40px; */
    text-align: center;
    font-size: 100%
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
<script>
  $(document).ready(function(){
    $("#discount2").keyup(function(){
      console.log('discount');
      console.log('discount',$("#discount2").val());


      if ($("#discount2").val() != 0  ){

       
        $("#priceall").val(parseInt($('#priceSum').val())-parseInt($("#discount2").val()))
        $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()));
      }else{
        // alert('กรุณาเพิ่มสินค้าใส่ตะกร้าก่อน')
      }
    });

    $("#discount2").change(function(){
      $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()))
      $("#priceall").val(parseInt($('#priceSum').val())-parseInt($("#discount2").val()))
    });
      $("#priceall").val(parseInt($('#priceSum').val())-parseInt($("#discount2").val()))


      $("#cash").keyup(function(){
        
        $('#change').val(parseInt($('#cash').val())-parseInt($('#priceall').val()))
      });
    // });


    // $('$')
  });
</script>

@stop