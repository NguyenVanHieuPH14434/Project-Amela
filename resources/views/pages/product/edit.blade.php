@extends('layouts.admin.master')
@section('title', 'Cập nhật sản phẩm')
@section('titleContent', 'Cập nhật sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel-body row">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Tên sản phẩm</b></label>
                            <input type="text" class="form-control" name="product_name" value="{{$product->product_name?$product->product_name:old('product_name')}}">
                            <input type="hidden" class="form-control" name="id" value="{{$product->id}}">
                            <input type="hidden" class="form-control" name="createUser" value="createUser">
                            @error('product_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Danh mục sản phẩm</b></label><br>
                            <select class="js-example-basic-multiple form-control" data-placeholder="Chọn danh mục sản phẩm"
                                name="category_id[]" multiple="multiple">
                                @foreach ($categories as $cate)
                                  <option {{$product->categoryProduct->contains('id', $cate->id)?"selected":""}} value="{{$cate->id}}">{{$cate->cate_name}}</option>
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
                                {{-- <div class="row d-flex">
                                    <label for="" class="ml-2">Ảnh cũ</label>
                                    <div class="col-12"> --}}
                                        <img src="{{asset($product->product_image)}}" class="mt-2" width="120px" alt="" class="mb-2">
                                    {{-- </div>
                                </div> --}}
                                @error('product_image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="col-md-3 control-label m-0 p-0 mb-2">Các hình ảnh</label>
                            <input type="file" class="file" data-val="2" name="image[]" hidden onchange="handleFileSelect()" multiple>
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file2">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <output id="result" class="mt-2" style="display: flex"/>
                                {{-- <div class="row d-flex">
                                    <label class="ml-2" for="">Các ảnh cũ</label>
                                    <div class="col-12"> --}}
                                            @foreach ($product->productGallery as $itemImage)
                                                <img src="{{asset($itemImage->path_image)}}" class="mt-2" width="120px" alt="" class="mb-2">
                                            @endforeach
                                    {{-- </div> --}}
                                {{-- </div> --}}
                        </div>
                    </div>

                    <div class="panel-body row" style="margin-top: -5px">
                        <div class="mb-3 col-6">
                            <label for="" class="form-label"><b>Mô tả ngắn</b></label>
                            <textarea name="product_short_desc" class="form-control" cols="30" rows="10">{{$product->product_short_desc?$product->product_short_desc:old('product_short_desc')}}</textarea>
                            @error('product_short_desc')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                        <div class="mb-3 col-6">

                            <div class="row col-12 p-0 m-0">
                                <div class="row col-12 p-0 m-0 mb-2">
                                    <label for="" class="form-label"><b>Thuộc tính</b></label>
                                    <select class="js-example-basic-multiple form-control"  id="id_of_select" data-placeholder="Chọn thuộc tính"
                                        name="attr[]"  multiple="multiple" onchange="testSelect()">
                                        @foreach ($attrs as $attr)
                                            <optgroup label="{{$attr->attr_name}}">
                                                    @foreach ($attr->getSubAttribute as $sub)
                                                        <option {{$product->attributeProduct->contains('id', $sub->id)?"selected":""}} value="{{$sub->id}}">{{$sub->attr_name}}</option>
                                                    @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row col-12 p-0 m-0">
                                    <label for="" class="form-label"><b>Giá sản phẩm</b></label>
                                    <input type="text" id="inputTaggs" data-role="tagsinput" class="form-control" name="product_price" value="{{implode(',', $price)}}">
                                    @error('product_price')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row col-12 p-0 m-0">
                                    <label for="" class="form-label"><b>Số lượng hàng</b></label>
                                    <input type="text" class="form-control bg-cyan" id="tags-inp" name="stock" placeholder="Số lượng nhập kho" value="{{implode(',',$stock)}}" data-role="tagsinput">
                                    @error('stock')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div id="more_item1"></div>

                            </div>
                        </div>

                    </div>
                    <div class="panel-body row">
                        <div class="mb-3 col-12">
                            <label for="" class="form-label"><b>Mô tả</b></label>
                           <textarea name="product_desc" class="form-control" cols="30" rows="10">{{$product->product_desc?$product->product_desc:old('product_desc')}}</textarea>
                            @error('product_desc')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        </div>
                    </div>

                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

