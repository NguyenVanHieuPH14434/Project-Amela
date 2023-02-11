@extends('layouts.admin.master')
@section('title', 'Cập nhật biến thể sản phẩm')
@section('titleContent', 'Cập nhật biến thể sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('products.updateAttr', $product->id) }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                  
                    <div class="panel-body row" style="margin-top: -5px">
                        @if (count($product->attributeProduct) == 0)
                            <div class="col-12 text-center">
                                <label for="">Chưa có biến thể nào. Bấm vào nút bên dưới để tạo biến thể cho sản phẩm!</label>
                            </div>
                            <a class="m-auto btn btn-success" href="{{ route('products.createAttr', $product->id) }}">Tạo biến thể</a>
                        @else
                        @foreach ($product->attributeProduct as $key => $it )
                        <div class="col-1">
                            <label for="">Thuộc tính {{ $key+1 }}:</label>
                        </div>
                        <div class="mb-3 col-5">
                                <div class="row col-12 p-0 m-0">
                                    <div class="row col-12 p-0 m-0 mb-2">
                                        <input type="hidden" name="productAttrId[]" value="{{ $it->pivot->id }}">
                                        <label for="" class="form-label"><b>Màu sắc</b></label>
                                        <select class="form-control" data-placeholder="Chọn thuộc tính"
                                            name="color_id[]" >
                                            @foreach ($attrs as $color)
                                               @if ($color->attr_key == 'color')
                                               <option {{ $it->id == $color->id ?"selected":"" }} value="{{$color->id}}">{{$color->attr_name}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row col-12 p-0 m-0 mb-2">
                                        <label for="" class="form-label"><b>Size</b></label>
                                        <select class="form-control" data-placeholder="Chọn thuộc tính"
                                            name="size_id[]">
                                            @foreach ($attrs as $size)
                                               @if ($size->attr_key == 'size')
                                               <option {{ $product->sizeProduct[$key]->id == $size->id?"selected":"" }} value="{{$size->id}}">{{$size->attr_name}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row col-12 p-0 m-0">
                                        <label for="" class="form-label"><b>Giá sản phẩm</b></label>
                                        <input type="text"  class="form-control" name="price[]" value="{{$it->pivot->price?$it->pivot->price:old('price')}}">
                                        @error('price')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row col-12 p-0 m-0">
                                        <label for="" class="form-label"><b>Số lượng hàng</b></label>
                                        <input type="text" class="form-control" name="stock[]" value="{{$it->pivot->stock?$it->pivot->stock:old('stock')}}">
                                        @error('stock')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                </div>

                        </div>
                        @endforeach
                        @endif


                    </div>

                    <button class="btn btn-primary">Cập nhật biến thể</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

