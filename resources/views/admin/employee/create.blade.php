@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>เพิ่มข้อมูลพนักงาน {{$Branch->name}}</h1>
@stop

@section('content')
  {{-- add user --}}
  <div class="container">
     <!-- Horizontal Form -->
     <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">เพิ่มพนักงาน</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ route('admin.employee.store') }}"  method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label"   for="inputWarning"><i ></i> ประจำ
            </label>
            <div class="col-sm-10">
              <input type="text" name="branch" class="form-control is-warning" id="inputWarning" placeholder="Enter ..." value="{{$Branch->name}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ</label>
            <div class="col-sm-10 input-group mb-3">
              <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="ชื่อ">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">อีเมล์</label>
            <div class="col-sm-10 input-group mb-3">
              <input type="text" name="email" class="form-control  @error('password') is-invalid @enderror" placeholder="mtn">
              <div class="input-group-append">
                <span class="input-group-text">@mtn.com</span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">รหัสผ่าน</label>
            <div class="col-sm-10">
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3" placeholder="A-Z,a-z,0-9">
              @error('password')
              <p class="text-danger">กรุณาใส่รหัสผ่านให้ถูกต้อง {{ $message }} </p>
              @enderror
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3"  class="col-sm-2 col-form-label">ตำแหน่งาน</label>
            <div class="col-sm-10">
              <select class="form-control  @error('password') is-invalid @enderror" id="sel1" name="role">
                @foreach ($roles as $item)
                    <option value="{{$item->id}}">
                      @if ($item->name == 'Manager') 
                          ผู้จัดการ
                      @elseif($item->name == 'BranchManagerAssistant') 
                          ผู้ช่วยผู้จัดการสาขา
                      @elseif($item->name == 'Salesperson') 
                          พนักงานขาย
                      @elseif($item->name == 'DeliveryStaff') 
                          พนักงานส่งของ
                      @elseif($item->name == 'GeneralStaff') 
                          พนักงานทั่วไป
                      @else 
                          {{$item->name}}
                      @endif
                      </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputsalary" class="col-sm-2 col-form-label">อัตราค่าจ้าง</label>
            <div class="col-sm-10">
              <input type="number" name="salary" class="form-control @error('password') is-invalid @enderror" id="inputsalary" placeholder="ตัวเลข 0-100,000">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="{{ route('admin.dashborad.index') }}" class="btn btn-default float-left">Cancel</a>
          <button type="submit" class="btn btn-info float-right" > บันทึกข้อมูล </button>
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
      