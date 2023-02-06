@extends('layouts.admin.master')
@section('title', 'Danh sách tài khoản người dùng')
@section('titleContent', 'Danh sách tài khoản người dùng')
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

                                <a href="{{ route('users.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i>Thêm</a>

                            </div>
                            <div class="col-sm-8 table-toolbar-right">
                                <div class="form-group">
                                    <form action="{{ route('users.search') }}" method="get">
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
                                    <th scope="col">#</th>
                                    <th scope="col">Tên đăng nhập</th>
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Ảnh</th>
                                   <th scope="col" class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($listUser->total() != 0)

                                @foreach ($listUser as $item)

                                <tr>
                                    <td scope="col" ><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    <td scope="col" >{{$item->username}}</td>
                                    <td scope="col" >{{$item->getProfile->full_name}}</td>
                                    <td scope="col" ><img src="{{asset($item->getProfile->avatar)}}" width="100px" alt=""></td>

                                    <td scope="col" class="text-center justify-content-center d-flex">
                                        <a href="{{ route('users.edit', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>

                                        @if (Auth::guard('web')->user()->id != $item->id)

                                        <form id="deleteForm{{ $item->id }}" action="{{ route('users.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        </form>
                                        <button data-form="deleteForm{{$item->id}}"  class="btn btn-danger btn-delete" style="border: none" ><i class="fa-regular fa-trash-can"></i></button>
                                        @endif
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
                        {{$listUser->links()}}
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>


@endsection
