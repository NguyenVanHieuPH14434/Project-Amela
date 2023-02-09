@extends('layouts.admin.master')
@section('title', 'Tạo mới trạng thái')
@section('titleContent', 'Tạo mới trạng thái')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('orderStatus.store') }}" method="post">
                    @csrf

                    <div class="panel-body mb-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên trạng thái</b></label>
                            <input type="text" class="form-control" name="status_name" value="{{old('status_name')}}">
                            @error('status_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('orderStatus.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

