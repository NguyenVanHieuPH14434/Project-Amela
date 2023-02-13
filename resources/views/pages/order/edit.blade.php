@extends('layouts.admin.master')
@section('title', 'Cập nhật trạng thái đơn hàng')
@section('titleContent', 'Cập nhật trạng thái đơn hàng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Cập nhật vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <form action="{{ route('orders.update', $order->id) }}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="panel-body">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Tên người nhận</b></label>
                            <input type="text" class="form-control" disabled name="customer" value="{{$order->customer}}">
                        </div>

                    </div>

                    <div class="panel-body mt-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Mã đơn hàng</b></label>
                            <input type="text" class="form-control" disabled name="code_order" value="{{$order->code_order}}">
                        </div>

                    </div>

                    <div class="panel-body mt-3 mb-3">
                        <div class="col-12">
                            <label for="" class="form-label"><b>Trạng thái</b></label>
                            <select name="status_order" class="form-control">
                                @foreach ($listStatusOrder as $statusOrder)
                                    <option {{ $order->status_order == $statusOrder->id?"selected":""}} value="{{ $statusOrder->id }}">
                                        {{ $statusOrder->status_name }}
                                    </option>   
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <button class="btn btn-primary">Lưu thay đổi</button>
                    <a href="{{ route('orders.index') }}" class="btn btn-info">Quay lại</a>

                </form>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>

@endsection

