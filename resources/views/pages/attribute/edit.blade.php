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
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>{{ __('Thuộc tính') }}</b></label>
                                <select name="attr_key" id="attr_key" class="form-control">
                                    <option value="">Chọn thuộc tính</option>
                                    @foreach (Config::get('attributes.attributes') as $key => $value)
                                        <option {{ $attr->attr_key == $key?"selected":"" }} value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('attr_key')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="panel-body name_attr">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Tên biến thể</b></label>
                                    <input type="text" class="form-control" name="attr_name" value="{{$attr->attr_name?$attr->attr_name:old('attr_name')}}">
                                  
                                </div>
                            </div>
                            @if ($attr->attr_value != null)
                                
                            <div class="panel-body value_attr">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Giá trị</b></label>
                                    <input type="color" name="attr_value" class="form-control" value="{{$attr->attr_value?$attr->attr_value:old('attr_value')}}">
                                </div>
                            </div>
                            @endif

                            <div class="panel-body">
                                <div class="mb-3">
                                    <label for="" class="form-label"><b>Ảnh</b></label> <br>
                                    <input type="file" name="attr_img" data-val="1" style="display: none" class="file">
                                    <div class="input-group my-2">
                                        <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file1">
                                        <div class="input-group-append">
                                            <button type="button" class="browse btn btn-primary">Browse..</button>
                                        </div>
                                    </div>
                                    <img src="" id="previewImage1" width="120px" alt="" class="mb-2">
                                </div>
                            </div>
                        </div>
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

