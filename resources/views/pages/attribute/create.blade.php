@extends('layouts.admin.master')
@section('title', 'Tạo mới thuộc tính')
@section('titleContent', 'Tạo mới thuộc tính')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->

                <form action="{{ route('attributes.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="panel-body">
                        <div class="mb-3">
                            <label for="" class="form-label"><b>{{ __('Thuộc tính') }}</b></label>
                            {{-- <input type="text" class="form-control" name="attr_key" value="{{old('attr_key')}}"> --}}
                            <select name="attr_key" id="attr_key" class="form-control">
                                <option value="">Chọn thuộc tính</option>
                                @foreach (Config::get('attributes.attributes') as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('attr_key')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="add_more_item">Thêm biến thể</button>
                    <div class="row " id="fooBar">
                    <input type="hidden" id="getIndex" value="1">
                    <div class="col-4">
                        <div class="panel-body name_attr">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>Tên biến thể</b></label>
                                <input type="text" class="form-control" name="attr_name[]" value="{{old('attr_name')}}">
                              
                            </div>
                        </div>
                        <div class="panel-body value_attr">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>Giá trị</b></label>
                                <input type="color" name="attr_value[]" class="form-control" value="{{old('attr_value')}}">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>Ảnh</b></label> <br>
                                <input type="file" name="attr_img[]" data-val="1" style="display: none" class="file">
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
                    <div id="more_item" class="col-4"></div>
                  </div>

                    <button class="btn btn-primary">Thêm mới</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('attributes.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection
@section('page-js')
    <script>
        $('#attr_key').change(function (e) { 
           var _key = $(this).val();
           if(_key == 'size'){
            $('.value_attr').hide();
            $('.name_attr').show();
           }else{
            $('.value_attr').show();
            $('.name_attr').show();
           }
        });
    </script>
@endsection

