@extends('layouts.admin.master')
@section('title', 'Thêm biến thể sản phẩm')
@section('titleContent', 'Thêm biến thể sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
 <form action="{{ route('products.storeAttr', $product->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                    <button class="btn btn-success mb-3" id="add_more_item_attr">Thêm biến thể</button>
                    <input type="hidden" id="getIndexAttr" value="{{ count($product->attributeProduct)?count($product->attributeProduct)+1:1 }}">
                    <div class="panel-body row _wrapParent" style="margin-top: -5px">
                        @foreach ($product->attributeProduct as $key => $it )
                        <div class="col-1">
                            <label for="">Thuộc tính {{ $key+1 }}:</label>
                        </div>
                        <div class="mb-3 col-5">
                                <div class="row col-12 p-0 m-0">
                                    <div class="row col-12 p-0 m-0 mb-2">
                                        <input type="hidden" name="productAttrId[]" value="{{ $it->pivot->id }}">
                                        <label for="" class="form-label"><b>Màu sắc</b></label>
                                        <select disabled class="form-control" data-placeholder="Chọn thuộc tính" >
                                            @foreach ($attrs as $color)
                                               @if ($color->attr_key == 'color')
                                               <option {{ $it->id == $color->id ?"selected":"" }} value="{{$color->id}}">{{$color->attr_name}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row col-12 p-0 m-0 mb-2">
                                        <label for="" class="form-label"><b>Size</b></label>
                                        <select disabled class="form-control" data-placeholder="Chọn thuộc tính">
                                            @foreach ($attrs as $size)
                                               @if ($size->attr_key == 'size')
                                               <option {{ $product->sizeProduct[$key]->id == $size->id?"selected":"" }} value="{{$size->id}}">{{$size->attr_name}}</option>
                                               @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row col-12 p-0 m-0">
                                        <label for="" class="form-label"><b>Giá sản phẩm</b></label>
                                        <input type="text" readonly class="form-control" name="priceOld[]" value="{{$it->pivot->price?$it->pivot->price:0}}">
                                        @error('price')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="row col-12 p-0 m-0">
                                        <label for="" class="form-label"><b>Số lượng hàng</b></label>
                                        <input type="text" disabled class="form-control" value="{{$it->pivot->stock?$it->pivot->stock:old('stock')}}">
                                        @error('stock')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                               
                        </div>
                        @endforeach

                        <div id="more_item_attr"></div>
                    </div>

                    <button class="btn btn-primary"  id="add_attr_btn">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('products.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection
@section('page-js')
<script>
    var indx = $( "#getIndexAttr" ).val();
     $(document).ready(function () {
        $('#add_attr_btn').attr("disabled", "disabled");
            $(document).on('click', '#add_more_item_attr', function (e) {
                e.preventDefault();
                var out=
                `<div class='col-6 d-flex flex-wrap mb-4'>
                    <label for="" class='col-2'>Thuộc tính ${Number(indx)}:</label>
                    <div class="attr_items mb-3 col-10 p-0 m-0">
                        <div class="row col-12 p-0 m-0">
                            <div class="row col-12 p-0 m-0 mb-2">
                                <label for="" class="form-label"><b>Màu sắc</b></label>
                                <select class="form-control" data-placeholder="Chọn thuộc tính"
                                    name="color_id[]" >
                                    @foreach ($attrs as $color)
                                        @if ($color->attr_key == 'color')
                                        <option value="{{$color->id}}">{{$color->attr_name}}</option>
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
                                        <option  value="{{$size->id}}">{{$size->attr_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="row col-12 p-0 m-0">
                                <label for="" class="form-label"><b>Giá sản phẩm</b></label>
                                <input type="text" class="form-control" name="price[]" value="{{old('price')}}">
                                @error('price')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="row col-12 p-0 m-0">
                                <label for="" class="form-label"><b>Số lượng hàng</b></label>
                                <input type="text" class="form-control" name="stock[]" value="{{old('stock')}}">
                                @error('stock')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <button style='margin-left:127px' class='px-3 btn btn-danger d-block remove_item_attr'>Remove</button>
                </div>
                    `;
                    if(indx < 11){
                    indx++;
                    $("._wrapParent").append(out);
                }

                if(indx >= 2){
                     $('#add_attr_btn').removeAttr("disabled");
                }

            });

            $('._wrapParent').on('click', '.remove_item_attr', function (e) {  
                e.preventDefault();
                $(this).parent('div').remove();
                indx--;
                if(indx < 2){
                    $('#add_attr_btn').attr("disabled", "disabled");
                }
            });

        });
</script>
@endsection

