@extends('layouts.admin.master')
@section('title', 'Tạo mới quyền')
@section('titleContent', 'Tạo mới quyền')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới quyền</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('permissions.store') }}" method="post">
                    @csrf
                    <div class="panel-body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mô-đun</h3>
                            </div>
                            <div class="panel-body">
                                <select id="demo-select2" name="module" class="demo_select2 form-control">
                                    <optgroup label="Select permission parent">
                                        <option value="">Chọn mô-đun</option>
                                        @foreach (Config::get('permission.module') as $key => $parent)
                                            <option value="{{$key}}">{{$parent}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                                @error('module')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="panel-body mb-3">
                            <div class="panel col-md-6">
                                <h4 class="text-main mt-3">Các quyền</h4>
                                <ul class="list-inline" style="display: flex; gap: 15px; margin: 0">
                                    @foreach (Config::get('permission.action'); as $key => $childrent)
                                    <li style="">
                                        <input id="demo-sw-sz-lg"  name="action[]" type="checkbox"  value="{{$key}}">
                                        <label class="form-check-label" for="">{{$childrent}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                                @error('action')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

