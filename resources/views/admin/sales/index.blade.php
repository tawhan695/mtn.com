@extends('adminlte::page')

@section('title', 'มัทนาไข่สด')
@section('head')
 
@endsection
@section('content_header')
    <h3>การขาย 
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
    </h3>
@stop

@section('content')

<div class="row">
  <div class="col-lg-12 p-3">
    <div class="row">
      <div class="col-12 col-lg-6 ">
        <div class="btn-group btn-group-lg btn-block">
          <button type="button" class="btn btn-outline-warning  btn-lg">
            2500 
            <span class="badge badge-light text-warning">฿</span>
          </button>
          <button type="button" class="btn btn-warning" style="width: 10%">
            <i class="fas fa-shopping-cart" style="color: white"></i>
            <span class="badge badge-pill badge-warning text-white">X1</span>
          </button>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-6">
          
            <div class="mt-3 mb-3">
              <input class="form-control form-control-sm " type="text" placeholder="ค้นหา"
              aria-label="Search">
            </div>
            
          
          </div>
      </div>
   
      
    </div>
  </div>
  <div class="col-lg-12 p-3">
        <div class="row">
          {{-- < --}}
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          <div class="col-6 col-lg-4">
            <div class="card" style="width:100%">
              <img class="card-img-top" src="{{asset('storage/images/unnamed.jpg')}}" alt="Card image" style="width:100%">
              <div class=" text-center">
                <h5 class="">ไข่ no.1</h5>
                <p class="">100 ฿</p>
                {{-- <a href="#" class="btn btn-primary">See Profile</a> --}}
              </div>
             </div>
          </div>
          
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
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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