@extends('layouts.admin.master')
@section('title', 'Danh sách danh mục bài viết')
@section('titleContent', 'Danh sách danh mục bài viết')
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

                                <a href="{{ route('categoryNews.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i>Thêm</a>

                            </div>
                            <div class="col-sm-8 table-toolbar-right">
                                <div class="form-group">
                                    <form action="{{ route('categoryNews.search') }}" method="get">
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
                                    <th>Tên danh mục bài viết</th>
                                    <th>Ảnh</th>
                                   <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($listCateNew->total() != 0)

                                @foreach ($listCateNew as $item)

                                <tr>
                                    <td ><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    <td >{{$item->new_cate_name}}</td>
                                    <td ><img src="{{asset($item->new_cate_image)}}" width="100px" alt=""></td>

                                    <td class="text-center d-flex justify-content-center ">
                                        <a href="{{ route('categoryNews.edit', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                                        <form id="deleteForm{{ $item->id }}" action="{{ route('categoryNews.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <button data-form="deleteForm{{$item->id}}"  class="btn btn-danger btn-delete" style="border: none" ><i class="fa-regular fa-trash-can"></i></button>
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
                        {{$listCateNew->links()}}
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>


@endsection
