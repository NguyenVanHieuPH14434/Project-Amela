@extends('layouts.admin.master')
@section('title', 'Danh sách đơn hàng')
@section('titleContent', 'Danh sách đơn hàng')
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
                                    <form action="{{ route('orders.search') }}" method="get">
                                        <input type="text" autocomplete="off" name="key" class="form-control"
                                            placeholder="Search" id="demo-input-search2">
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhận</th>
                                    <th>Địa chỉ nhận hàng</th>
                                    <th>Ngày đặt</th>
                                    <th>Trạng thái</th>
                                   <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($listOrder->total() != 0)

                                @foreach ($listOrder as $item)

                                <tr>
                                    <td scope="col"><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    <td scope="col">{{$item->code_order}}</td>
                                    <td scope="col">
                                        {{$item->customer}}
                                    </td>
                                    <td scope="col"> {{$item->address}}</td>
                                    <td scope="col"> {{$item->created_at}}</td>
                                    <td scope="col"> 
                                        <select name="" class="form-control">
                                            @foreach ($listStatusOrder as $statusOrder)
                                                <option {{ $item->getStatuss->id == $statusOrder->id?"selected":"" }} value="{{ $statusOrder->id }}">
                                                    {{ $statusOrder->status_name }}
                                                </option>   
                                            @endforeach
                                        </select>
                                    </td>

                                    <td scope="col" class="text-center d-flex justify-content-center ">
                                        <a href="{{ route('orders.show', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>

                                        {{-- <form id="deleteForm{{ $item->id }}" action="{{ route('orders.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <button data-form="deleteForm{{$item->id}}"  class="btn btn-danger btn-delete" style="border: none" ><i class="fa-regular fa-trash-can"></i></button> --}}
                                    </td>

                                </tr>

                                @endforeach
                            </tbody>
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
                        {{$listOrder->links()}}
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>


@endsection
