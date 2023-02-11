@extends('layouts.admin.master')
@section('title', 'Tạo mới sản phẩm')
@section('titleContent', 'Tạo mới sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Tên sản phẩm</b></label>
                            <input type="text" class="form-control" name="product_name" value="{{old('product_name')}}">
                            <input type="hidden" class="form-control" name="createUser" value="createUser">
                            @error('product_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label"><b>Danh mục sản phẩm</b></label>

                            <select class="js-example-basic-multiple form-control" data-placeholder="Chọn danh mục sản phẩm"
                                name="category_id[]" multiple="multiple">
                                @foreach ($categories as $cate)
                                  <option value="{{$cate->id}}">{{$cate->cate_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                         @enderror
                        </div>

                    </div>
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Ảnh</b></label> <br>
                            <input type="file" name="product_image" data-val="1" onchange="preview()" style="display: none" class="file">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file1">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <img src="" id="previewImage" class="mt-2" width="120px" alt="" class="mb-2">
                                @error('product_image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label class="col-md-3 control-label">Các hình ảnh</label>
                            <input type="file" class="file" data-val="2" name="image[]" hidden onchange="handleFileSelect()" multiple>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file2">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <output id="result" class="mt-2" style="display: flex"/>
                                @error('image.*')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="panel-body row" style="margin-top: -5px">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Mô tả ngắn</b></label>
                            <textarea name="product_short_desc" class="form-control" cols="30" rows="10">{{old('product_short_desc')}}</textarea>
                            @error('product_short_desc')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">

                        </div>

                    </div>
                    <div class="panel-body row">
                        <div class="mb-3 col-12">
                            <label for="" class="form-label"><b>Mô tả</b></label>
                           <textarea name="product_desc" class="form-control" cols="30" rows="10">{{old('product_desc')}}</textarea>
                            @error('product_desc')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

