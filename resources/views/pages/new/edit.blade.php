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
                <form action="{{ route('news.update', $new->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="panel-body">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên bài viết</b></label>
                            <input type="text" class="form-control" name="new_title" value="{{$new->new_title?$new->new_title:old('new_title')}}">
                            <input type="hidden" class="form-control" name="id" value="{{$new->id}}">
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
                                    <option {{$new->getCateNew->contains('id', $item->id)?"selected":""}} value="{{$item->id}}">{{$item->new_cate_name}}</option>
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
                            <textarea name="new_content" class="form-control" cols="30" rows="10">{{$new->new_content?$new->new_content:old('new_content')}}</textarea>
                            @error('new_content')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>


                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('news.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

