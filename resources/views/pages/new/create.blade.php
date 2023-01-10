@extends('layouts.admin.master')
@section('title', 'Tạo mới bài viết')
@section('titleContent', 'Tạo mới bài viết')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('news.store') }}" method="post">
                    @csrf

                    <div class="panel-body">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên bài viết</b></label>
                            <input type="text" class="form-control" name="new_title" value="{{old('new_title')}}">
                            <input type="hidden" class="form-control" name="createUser" value="createUser">
                            @error('new_title')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="panel-body mt-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Danh mục bài viết</b></label>
                           <select class="js-example-basic-multiple form-control" name="cateNew[]" data-placeholder="Chọn danh mục sản phẩm" multiple>
                                @foreach ($cateNews as $item)
                                    <option value="{{$item->id}}">{{$item->new_cate_name}}</option>
                                @endforeach
                           </select>
                            @error('cateNew')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>


                    <div class="panel-body mt-3 mb-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Nội dung</b></label>
                            <textarea name="new_content" class="form-control" cols="30" rows="10">{{old('new_content')}}</textarea>
                            @error('new_content')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>


                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('categoryNews.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection

