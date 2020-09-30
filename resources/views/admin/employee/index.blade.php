@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ข้อมูลพนักงาน {{$Branch->name}}</h1>
@stop

@section('content')
  <div class="container-full text-center" style="width: 100% ;">
    <a href="{{ route('admin.employee.create', ['id' => $Branch->id ]) }}" class="btn btn-app bg-info" style="width: 300px; height: 100px;">
      <span class="badge bg-danger">New</span>
      <i class="fas fa-users"></i> <h3>เพิ่มพนักงาน {{$Branch->name}}</h3>
    </a>
  </div>
  {{-- add user
  <div class="container">
     <!-- Horizontal Form -->
     <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Horizontal Form</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form class="form-horizontal">
        <div class="card-body">
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
          </div>
          <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck2">
                <label class="form-check-label" for="exampleCheck2">Remember me</label>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-info">Sign in</button>
          <button type="submit" class="btn btn-default float-right">Cancel</button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
  </div> --}}

  <div class="row">
    @if (count($User) != 0)   
    @foreach ($User as $item)
    <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-4 ">
      <!-- Widget: user widget style 2 -->
      <div class="card card-widget widget-user-2">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-warning">
          <div class="widget-user-image">
            @if ($item->image == null)   
            <img class="img-circle elevation-2" src="https://picsum.photos/300/300" alt="User Avatar">
            @else
            <img class="img-circle elevation-2" src="{{ $item->image }}" alt="User Avatar">
            @endif
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username">{{ $item->name }}</h3>
          <h5 class="widget-user-desc">
            @php
                  $desc = $item->roles()->first()->name;
                  $name = 'null';
                  if ($desc == 'Manager') {
                      # code...
                      $name = 'ผู้จัดการ';
                  } else if($desc == 'BranchManagerAssistant') {
                      # code...
                      $name = 'ผู้ช่วยผู้จัดการสาขา';
                  } else if($desc == 'Salesperson') {
                      # code...
                      $name = 'พนักงานขาย';
                  } else if($desc == 'DeliveryStaff') {
                      # code...
                      $name = 'พนักงานส่งของ';
                  } else if($desc == 'GeneralStaff') {
                      # code...
                      $name = 'พนักงานทั่วไป';
                  }
            @endphp 
              {{   
                $name
              }}
          </h5>
        </div>
        <div class="card-footer p-0">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <span class=" badge bg-primary">Emlil : </span> {{$item->email}}
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <span class=" badge bg-info">Phone : </span> รออัพเดท
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                @if ($item->salary == null)
                <span class=" badge bg-success text-danger">อัตราค่าจ้าง : </span> 
                รออัพเดท
                @else
                <span class=" badge bg-success">อัตราค่าจ้าง : </span> 
                  {{$item->salary}}   
                 @endif
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <span class=" badge bg-danger">ประจำ : </span> {{$item->branch()->first()->name}}
              </a>
            </li>
            @can('edit-employee')
            <li class="nav-item">
              <div class="row float-right p-2 ">
                  <div class="text-center" style="padding-right: 10px">
                    <div class="float-right"  style="padding-right: 10px">
                      <form id="delete-company" action="{{ route('admin.employee.destroy', $item->id) }}" method="POST">
                        {{csrf_field()}}
                        {{method_field('delete')}}
                        <button style="padding-right: 10px" type="button" onclick="confirmDelete('delete-company')" class="btn btn-danger btn-sm">ปลดพนักงาน</button>
                      </form>
                    </div>
                    <div class="float-right"  style="padding-right: 10px">
                      <a href="{{ route('admin.employee.edit',$item->id) }}" class="btn btn-warning btn-sm">แก้ไข ตำแหน่หน้าที่งาน</a>
                    </div>
                  </div>
              </div>
            </li>
              
<script>
  function confirmDelete(item_id) {
      swal.fire({
          title: "คุณแน่ใจหรือไม่?",
          text: "ปลดพนักงาน!",
          icon: "warning",
          showCancelButton: true,
          buttons: true,
          dangerMode: true,
      })
          .then((willDelete) => {
              console.log(willDelete)
              if (willDelete.value) {
                  $('#'+item_id).submit();
              } else {
                  swal.fire("ยกเลิก ปลดพนักงาน");
              }
          });
  }
</script>
   


            @endcan
          </ul>
        </div>
      </div>

      <!-- /.widget-user -->
    </div>
    @endforeach
    @else
    <p class="text-center p-5">ไม่พบข้อมูล</p>
    @endif
  </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@stop
      