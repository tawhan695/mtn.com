@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>แก้ไขข้อมูลพนักงาน {{$Branch_user}}</h1>
@stop

@section('content')
  {{-- add user --}}
  <div class="container">
     <!-- Horizontal Form -->
     <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">แก้ไขข้อมูลพนักงาน</h3>
      </div>
      <!-- /.card-header -->
    
      <!-- form start -->
      <form class="form-horizontal" action="{{ route('admin.employee.update',$user) }}"  method="POST">
        @csrf
        @method('PUT')

        <div class="card-body">
          <div class="form-group row">
            <label for="inputPassword3"  class="col-sm-2 col-form-label">ตำแหน่งาน</label>
            <div class="col-sm-10">
              <select class="form-control  @error('password') is-invalid @enderror" id="sel1" name="branch">
                @foreach ($Branch as $item)
                    <option value="{{$item->id}}"
                       @if ($Branch_user == $item->name)
                      selected 
                      @endif>
                        {{$item->name}}
                      </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">ชื่อ</label>
            <div class="col-sm-10 input-group mb-3">
              <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" placeholder="ชื่อ" value="{{$user->name}}">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">อีเมล์</label>
            <div class="col-sm-10 input-group mb-3">
              <input type="text" name="email" class="form-control  @error('password') is-invalid @enderror" placeholder="mtn@mtn.com" value="{{$user->email}}">
             
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3"  class="col-sm-2 col-form-label">ตำแหน่งาน</label>
            <div class="col-sm-10">
              <select class="form-control  @error('password') is-invalid @enderror" id="sel1" name="role">
                @foreach ($role as $item)
                
                    <option value="{{$item->id}}" 
                      @if ($Role_user == $item->name)selected @endif>

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
              <input type="number" name="salary" 
                class="form-control @error('password') is-invalid @enderror" id="inputsalary" 
                placeholder="ตัวเลข 0-100,000"
                value="{{$user->salary}}"
                @if ($user->salary == null)
                    0
                @endif
                >
                {{-- @if ($user->salary == null)
                <p class="text-danger">รออัพเดท </p>
                @endif --}}
            </div>
          </div>
          <div class="form-group row">
            <label for="inputsalary" class="col-sm-2 col-form-label">เบอร์โทรศัพท์ :</label>
            <div class="col-sm-10">
              <input type="text" name="salary"  disabled
                class="form-control @error('password') is-invalid @enderror" id="inputsalary" 
                placeholder="รออัพเดท"
                >
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a href="{{ route('admin.dashborad.index') }}" class="btn btn-default float-left">Cancel</a>
          <button type="submit" class="btn btn-info float-right" > บันทึกการเแลี่ยนแปลง </button>
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
      