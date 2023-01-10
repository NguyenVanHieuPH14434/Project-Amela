@extends('layouts.admin.master')
@section('title', 'Cập nhật danh mục bài viết')
@section('titleContent', 'Cập nhật danh mục bài viết')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('categoryNews.update', $cateNew->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="panel-body">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên danh mục</b></label>
                            <input type="text" class="form-control" name="new_cate_name" value="{{$cateNew->new_cate_name?$cateNew->new_cate_name:old('new_cate_name')}}">
                            <input type="hidden" class="form-control" name="createUser" value="createUser">
                            @error('new_cate_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>


                    <div class="panel-body mt-3 mb-2">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Ảnh</b></label> <br>
                            <input type="file" name="new_cate_image" data-val="1" onchange="preview()" style="display: none" class="file">
                                <div class="input-group">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file1">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <img src="" id="previewImage" class="mt-2 mb-3" width="120px" alt="" class="mb-2">
                                <img src="{{asset($cateNew->new_cate_image)}}" class="mt-2 mb-3" width="120px" alt="" class="mb-2">
                                @error('new_cate_image')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>

                    </div>


                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('categoryNews.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

