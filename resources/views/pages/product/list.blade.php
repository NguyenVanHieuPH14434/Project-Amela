@extends('layouts.admin.master')
@section('title', 'Danh sách sản phẩm')
@section('titleContent', 'Danh sách sản phẩm')
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
                                <a href="{{ route('products.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i>Thêm</a>

                            </div>
                            <div class="col-sm-8 table-toolbar-right">
                                <div class="form-group">
                                    <form action="{{ route('products.search') }}" method="get">
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
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Ảnh</th>
                                   <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            @if ($listProduct->total() != 0)
                            <tbody>

                                @foreach ($listProduct as $item)

                                <tr>
                                    <td class="col-1"><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    <td class="col-3">{{$item->product_name}}</td>
                                    <td class="col-2">{{number_format($item->product_price)}}</td>
                                    <td class="col-3">
                                        @foreach ($item->categoryProduct as $cate)
                                            <p class="mb-2">{{$cate->cate_name}}</p>
                                        @endforeach
                                    </td>
                                    <td class="col-2"><img src="{{asset($item->product_image)}}" width="100px" alt=""></td>

                                    <td class="col-1 d-flex ">
                                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('products.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button data-form="deleteForm{{$item->id}}"  class="btn btn-danger btn-delete" style="border: none" ><i class="fa-regular fa-trash-can"></i></button> <br>

                                </td>

                                </tr>

                                @endforeach
                            </tbody>
                            @else
                            <tbody>
                                <tr>
                                    <th colspan="6" class="text-center">Trống!</th>
                                </tr>
                            </tbody>
                            @endif
                        </table>

                    </div>
                    <hr class="new-section-xs">
                    <div class="pull-right">
                        {{$listProduct->links()}}
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>


@endsection
