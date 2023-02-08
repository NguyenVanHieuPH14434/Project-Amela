@extends('layouts.admin.master')
@section('title', 'Cập nhật thuộc tính')
@section('titleContent', 'Cập nhật thuộc tính')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('attributes.update', $attr->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Tên thuộc tính</b></label>
                            <input type="text" class="form-control" name="parent_attr_name" value="{{$attr->attr_name?$attr->attr_name:old('parent_attr_name')}}">
                            @error('parent_attr_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="add_more_item">Thêm loại</button>
                    <div class="row" id="fooBar">
                        <input type="hidden" id="getIndex" value="{{count($attr->getSubAttribute)?count($attr->getSubAttribute):1}}">
                        @foreach ($attr->getSubAttribute as $key => $subAttr)
                        <div class="col-4">
                            <div class="panel-body">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Loại</b></label>
                                    <input type="text" class="form-control" name="sub_name[]" value="{{$subAttr->attr_name?$subAttr->attr_name:old('attr_name')}}">
                                    <input type="hidden" class="form-control" name="subId[]" value="{{$subAttr->id}}">
                                    
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Ảnh</b></label> <br>
                                
                                    <input type="file" name="sub_img[]" data-val="{{$key}}" style="display: none" class="file">
                                    <div class="input-group my-2">
                                        <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file{{$key}}">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Browse..</button>
                                        </div>
                                    </div>
                                    <img src="" id="previewImage{{$key}}" width="120px" style="max-height:100px" alt="" class="mb-2">
                                    <label for="" class="ml-2">Ảnh cũ</label>
                                    <img src="{{asset($subAttr->attr_img)}}" width="120px" style="max-height:100px" alt="" class="mb-2">
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Mô tả</b></label>
                                    <textarea name="sub_desc[]" class="form-control" cols="30" rows="10">{{$subAttr->attr_desc?$subAttr->attr_desc:old('attr_desc')}}</textarea>
                                </div>
                            </div>
                        </div>

                            @endforeach
                            <div id="more_item" class="col-4"></div>
                    </div>


                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('attributes.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

