@extends('layouts.admin.master')
@section('title', 'Cập nhật quyền')
@section('titleContent', 'Cập nhật quyền')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật quyền</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('permissions.update', $pms->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="panel-body">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Mô-đun</h3>
                                <input type="hidden" class="form-control" name="id" value="{{ $pms->id }}">
                            </div>
                            <div class="panel-body">
                                <select id="demo-select2" name="module" class="demo_select2 form-control">
                                    <optgroup label="Select permission parent">
                                        @foreach (Config::get('permission.module') as $key => $parent)
                                        @if ($pms->pms_name == $key)

                                        <option selected value="{{$key}}">{{$parent}}</option>
                                        @else

                                        <option value="{{$key}}">{{$parent}}</option>
                                        @endif
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

                        <div class="panel-body">
                            <div class="panel col-md-6">
                                <h4 class="text-main">Các quyền</h4>
                                <ul class="list-inline">
                                    @foreach (Config::get('permission.action'); as $key => $childrent)

                                    <li>
                                        <input id="demo-sw-sz-lg" name="action[]" type="checkbox" {{$pms->getChildrentPermission->contains('pms_key', $pms->pms_name .'_'.$key) ? 'checked':''}} value="{{$key}}">
                                        <label class="form-check-label" for="inlineCheckbox1">{{$childrent}}</label>

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
                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

