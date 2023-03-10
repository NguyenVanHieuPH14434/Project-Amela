@extends('layouts.admin.master')
@section('title', 'Danh sách quyền')
@section('titleContent', 'Danh sách quyền')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Danh sách quyền</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->
                <div class="panel-body">
                    <div class="pad-btm form-inline">
                        <div class="row mb-3">
                            <div class="col-sm-4 table-toolbar-left">
                                <a href="{{ route('permissions.create') }}" class="btn btn-info"><i class="fa-solid fa-plus"></i>Thêm</a>

                            </div>
                            <div class="col-sm-8 table-toolbar-right">
                                <div class="form-group">
                                    <form action="{{ route('permissions.search') }}" method="get">
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
                                    <th scope="col">Key mô đun</th>
                                    <th scope="col">Tên mô đun</th>
                                    <th scope="col" class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($listPermission->total() != 0)
                                @foreach ($listPermission as $item)
                                <tr>
                                    <td scope="col"><a href="#" class="btn-link">#{{$item->id}}</a></td>
                                    @php
                                    foreach (Config::get('permission.module') as $key => $parent){
                                        if($key == $item->pms_name){
                                            $permissionName = $parent;
                                        }
                                    }
                                    @endphp
                                    <td scope="col">{{$item->pms_name}}</td>
                                    <td scope="col">{{$permissionName}}</td>
                                    @if ($item->parent_id == 0)
                                    <td class="text-center justify-content-center d-flex">
                                        <a href="{{ route('permissions.edit', $item->id) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form id="deleteForm{{ $item->id }}" action="{{ route('permissions.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button data-form="deleteForm{{ $item->id }}" class="btn btn-danger btn-delete" style="border: none" ><i class="fa-regular fa-trash-can"></i></button>
                                    </td>
                                    @endif
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

                        {{$listPermission->links()}}
                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
@endsection
