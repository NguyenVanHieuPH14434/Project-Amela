@extends('layouts.admin.master')
@section('title', 'Chi tiết đơn hàng')
@section('titleContent', 'Chi tiết đơn hàng')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Danh sách vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row mb-3">
                            <div class="col-sm-4 table-toolbar-left">

                            </div>
                            <div class="col-sm-8 table-toolbar-right">
                                <div class="form-group">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Màu sắc</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($orderDetail['data']) != 0)
                                {{-- @dd($orderDetail['data'][0]); --}}
                                @foreach ($orderDetail['data'] as $item)

                                <tr>
                                    <td scope="col"><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    <td scope="col">{{$item->getProduct->product_name}}</td>
                                    <td scope="col"><img src="{{ asset($item->getProduct->product_image) }}" width="100px" alt=""></td>
                                    <td scope="col">
                                        {{$item->getAttrColor->attr_name}}
                                    </td>
                                    <td scope="col">
                                        {{$item->getAttrSize->attr_name}}
                                    </td>
                                    <td scope="col"> {{$item->quantity}}</td>
                                    <td scope="col"> {{number_format($item->price)}}</td>
                                    <td scope="col"> {{number_format($item->price * $item->quantity)}}</td>

                                </tr>

                                @endforeach
                            </tbody>
                            <tfoot>
                                <th colspan="6" style="text-align: center; padding-top: 5px">Tổng tiền</th>
                                <th colspan="2" style="text-align: center; padding-top: 5px">{{ number_format($orderDetail['customer']->total_price) }} vnđ</th>
                            </tfoot>
                            @else
                            <tbody>
                                <tr>
                                    <th colspan="3" class="text-center">Trống!</th>
                                </tr>
                            </tbody>
                            @endif
                        </table>

                    </div>
                    <hr class="new-section-xs">
                    <div class="pull-right">
                        <a href="{{ route('orders.index') }}" class="btn btn-info">Quay lại</a>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>


@endsection

