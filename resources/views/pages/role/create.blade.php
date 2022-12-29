@extends('layouts.admin.master')
@section('title', 'Tạo mới vai trò')
@section('titleContent', 'Tạo mới vai trò')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('roles.store') }}" method="post">
                    @csrf
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Tên vai trò</b></label>
                            <input type="text" class="form-control" name="role_name" value="{{old('role_name')}}" placeholder="Admin...">
                            @error('role_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Mô tả</b></label>
                            <textarea name="role_description" class="form-control" cols="30" rows="10">{{old('role_description')?old('role_description'):''}}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    <input type="checkbox" class="checkall">
                                    Chọn tất cả
                                </label>
                            </div>

                            @foreach($permissionParent as $parentItem)
                                <div class="card border-primary mb-3 col-md-12 Card">
                                    <div class="card-header" style="background: aqua">
                                        <label>
                                            <input type="checkbox" value="" class="checkbox_parent">
                                        </label>
                                        @php
                                             foreach (Config::get('permission.module') as $key => $parent) {
                                                if($key == $parentItem->pms_name){
                                                    $parentItem->pms_name = $parent;
                                                }
                                             }

                                         @endphp
                                             <label for=""><h4>{{ $parentItem->pms_name }}</h4></label>
                                    </div>
                                    <div class="row">
                                        @foreach($parentItem->getChildrentPermission as $childrentItem)

                                            <div class="card-body text-primary col-md-3">
                                                <h5 class="card-title">
                                                    <label>
                                                        <input type="checkbox" name="permission_id[]"
                                                               class="checkbox_childrent"
                                                               value="{{ $childrentItem->id }}">
                                                    </label>
                                                    @php
                                                    foreach (Config::get('permission.action') as $key => $childrent){
                                                    foreach (Config::get('permission.module') as $keyParent => $parent){
                                                        if($key == explode('_', $childrentItem->pms_key)[1]){
                                                            if(explode('_', $childrentItem->pms_key)[0] == $keyParent){
                                                            $childrentItem->pms_name = $childrent . ' ' . Str::lower($parent);
                                                            }
                                                        }
                                                        }
                                                    }
                                                @endphp
                                                    {{ $childrentItem->pms_name }}
                                                </h5>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach

                            @error('permission_id')
                           <div style="margin-bottom: 15px">
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                           </div>
                        @enderror


                        </div>


                    </div>


                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

