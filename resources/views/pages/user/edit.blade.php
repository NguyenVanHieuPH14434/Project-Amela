@extends('layouts.admin.master')
@section('title', 'Cập nhật tài khoản người dùng')
@section('titleContent', 'Cập nhật tài khoản người dùng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Tên đăng nhập</b></label>
                            <input type="text" class="form-control" readonly name="username" value="{{$user->username?$user->username:old('username')}}">
                            <input type="hidden" class="form-control" name="id" value="{{$user->id}}">
                            <input type="hidden" class="form-control" name="profile_id" value="{{$user->getProfile->id}}">
                            @error('username')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Họ và tên</b></label>
                            <input type="text" class="form-control" name="full_name" value="{{$user->getProfile->full_name?$user->getProfile->full_name:old('full_name')}}">
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
                            <input type="text" class="form-control" name="phone" value="{{$user->getProfile->phone?$user->getProfile->phone:old('phone')}}">
                            @error('phone')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Email</b></label>
                            <input type="text" class="form-control" name="email" value="{{$user->getProfile->email?$user->getProfile->email:old('email')}}">
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
                                <div class="mt-2">
                                    <label for="">Ảnh cũ</label> <br>
                                    <img src="{{asset($user->getProfile->avatar)}}" id="" class="mt-2" width="120px" alt="" class="mb-2">
                                </div>
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Mật khẩu</b></label>
                            <input type="password" class="form-control" name="password" readonly value="{{$user->password?$user->password:old('password')}}">
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
                                    <option {{$user->user_role->contains('id', $role->id)?"selected":""}} value="{{$role->id}}">{{$role->role_name}}</option>
                                @endforeach
                           </select>
                            @error('role')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>


                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

