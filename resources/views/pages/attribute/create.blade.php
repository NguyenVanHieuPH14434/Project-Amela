@extends('layouts.admin.master')
@section('title', 'Tạo mới thuộc tính')
@section('titleContent', 'Tạo mới thuộc tính')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Tên thuộc tính</b></label>
                            <input type="text" class="form-control" name="attr_name" value="{{old('attr_name')}}">
                            @error('attr_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Ảnh</b></label> <br>
                            <p class="btn btn-primary btn-file">
                                Browse...<input type="file" name="attr_img" onchange="preview()">
                            </p> <br>
                            <img src="" id="previewImage" width="120px" alt="" class="mb-2">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Mô tả</b></label>
                            <textarea name="attr_desc" class="form-control" cols="30" rows="10">{{old('attr_desc')?old('attr_desc'):''}}</textarea>
                        </div>
                    </div>

                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('attributes.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

