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


                    <form id="defaultForm" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Test 1</label>
                            <div class="col-lg-5">
                                <input type="text" name="cities" id="aa" class="form-control" value="testing,bootstrap's, tagsInput,validation," data-role="tagsinput" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Test 2</label>
                            <div class="col-lg-5">
                                <input type="text" name="cities1" id="aa1" class="form-control" value="s@d.com,a@b.com" data-role="tagsinput" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-5 col-lg-offset-3">
                                <button type="submit" class="btn btn-default">Validate</button>
                            </div>
                        </div>
                    </form>

                <!--===================================================-->
                <!--End Data Table-->

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
    $('#defaultForm')
        .find('[name="cities"]')
    // Revalidate the color when it is changed
    .change(function (e) {
        console.warn($('[name="cities"]').val());
        console.info($('#aa').val());
        console.info($("#aa").tagsinput('items'));
        var a = $("#aa").tagsinput('items');
        console.log(typeof (a));
        console.log(a.length);
        $('#defaultForm').bootstrapValidator('revalidateField', 'cities');
    })
        .end()
        .find('[name="cities1"]')
    // Revalidate the color when it is changed
    .change(function (e) {
        console.warn($('[name="cities1"]').val());
        console.info($('#aa1').val());
        console.info($("#aa1").tagsinput('items'));
        var a = $("#aa1").tagsinput('items');
        console.log(typeof (a));
        console.log(a.length);
        $('#defaultForm').bootstrapValidator('revalidateField', 'cities1');
    })
        .end()
        .bootstrapValidator({
        excluded: ':disabled',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            cities: {
                validators: {
                    notEmpty: {
                        message: 'Please enter at least one city you like the most'
                    }
                }
            },
            cities1: {
                validators: {
                    callback: {
                        message: 'Please enter a valid email address',
                        callback: function (value, validator) {
                            // Get the selected options
                            var options = validator.getFieldElements('cities1').tagsinput('items');
                            // console.info(options);
                            return (options !== null && options.length >= 2 && options.length <= 4);
                        }
                    }
                }
            }
        }
    })
        .on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
    });
});
    </script>
@endsection

