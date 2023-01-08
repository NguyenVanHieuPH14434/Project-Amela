@extends('layouts.admin.master')
@section('title', 'Tạo mới tài khoản người dùng')
@section('titleContent', 'Tạo mới tài khoản người dùng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Tên đăng nhập</b></label>
                            <input type="text" class="form-control" name="username" value="{{old('username')}}">
                            <input type="hidden" class="form-control" name="createUser" value="createUser">
                            @error('username')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Họ và tên</b></label>
                            <input type="text" class="form-control" name="full_name" value="{{old('full_name')}}">
                            @error('full_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Số điện thoại</b></label>
                            <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                            @error('phone')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Email</b></label>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}">
                            @error('email')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Ảnh</b></label> <br>
                            <input type="file" name="avatar" data-val="1" onchange="preview()" style="display: none" class="file">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file1">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <img src="" id="previewImage" class="mt-2" width="120px" alt="" class="mb-2">
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Mật khẩu</b></label>
                            <input type="password" class="form-control" name="password" value="{{old('password')}}">
                            @error('password')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Vai trò</b></label>
                           <select name="role" id="" class="form-control">
                               <option value="">Chọn vai trò</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                           </select>
                            @error('role')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('users.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

