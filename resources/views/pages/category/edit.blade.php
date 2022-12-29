@extends('layouts.admin.master')
@section('title', 'Cập nhật danh mục sản phẩm')
@section('titleContent', 'Cập nhật danh mục sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('categories.update', $cate->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Tên vai trò</b></label>
                            <input type="text" class="form-control" name="cate_name" value="{{$cate->cate_name}}">
                            <input type="hidden" class="form-control" name="id" value="{{$cate->id}}">
                            @error('cate_name')
                            <div style="margin-bottom: 15px">
                             <span class="text-danger" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                            </div>
                         @enderror

                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Danh mục cha</b></label>
                            <select name="parent_id" id="" class="form-control">
                                <option value="">Chọn danh mục cha</option>
                                @foreach ($allCate as $item)
                                    <option {{$cate->parent_id == $item->id?"selected":""}} value="{{$item->id}}">{{$item->cate_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Ảnh</b></label> <br>
                            <p class="btn btn-primary btn-file">
                                Browse...<input type="file" name="cate_image" onchange="preview()">
                            </p> <br>
                            <img src="" id="previewImage" width="120px" alt="" class="mb-2">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Ảnh cũ</b></label> <br>
                            <img src="{{asset($cate->cate_image)}}" width="120px" alt="" class="mb-2">
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>Mô tả</b></label>
                            <textarea name="cate_desc" class="form-control" cols="30" rows="10">{{$cate->cate_desc?$cate->cate_desc:old('cate_desc')}}</textarea>
                        </div>
                    </div>


                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

