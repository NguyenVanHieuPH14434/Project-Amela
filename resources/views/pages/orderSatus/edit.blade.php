@extends('layouts.admin.master')
@section('title', 'Cập nhật trạng thái')
@section('titleContent', 'Cập nhật trạng thái')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('orderStatus.update', $orderStatus->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="panel-body mb-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên trạng thái</b></label>
                            <input type="text" class="form-control" name="status_name" value="{{ $orderStatus->status_name?$orderStatus->status_name:old('status_name')}}">
                            @error('status_name')
                            <span class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <button class="btn btn-danger" type="reset">Nhập lại</button>
                    <a href="{{ route('orderStatus.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

