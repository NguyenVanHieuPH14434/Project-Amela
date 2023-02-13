@extends('layouts.admin.master')
@section('title', 'Thêm thuộc tính sản phẩm')
@section('titleContent', 'Thêm thuộc tính sản phẩm')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    {{-- <h3 class="panel-title">Tạo mới vai trò</h3> --}}
                </div>

                <!--Data Table-->
                <!--===================================================-->


                <style type="text/css">
                .bootstrap-tagsinput {
                    width: 100%;
                }
                .label {
                    line-height: 2 !important;
                }
                </style>

                <form id="bootstrapTagsInputForm" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Cities</label>
                        <div class="col-xs-8">
                            <input type="text" name="cities" class="form-control"
                                   value="Hanoi" data-role="tagsinput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Countries</label>
                        <div class="col-xs-8">
                            <input type="text" name="countries" class="form-control"
                                   value="Vietnam" data-role="tagsinput" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-5 col-xs-offset-3">
                            <button type="submit" class="btn btn-default">Validate</button>
                        </div>
                    </div>
                </form>


@endsection

