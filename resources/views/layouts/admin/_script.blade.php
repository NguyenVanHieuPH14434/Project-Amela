 <!-- jQuery -->
 <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- ChartJS -->
 <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
 <!-- Sparkline -->
 <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
 <!-- JQVMap -->
 <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
 <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
 <!-- jQuery Knob Chart -->
 <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
 <!-- daterangepicker -->
 <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
 <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
 <!-- Summernote -->
 <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
 <!-- overlayScrollbars -->
 <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('dist/js/adminlte.js') }}"></script>
 <!-- AdminLTE for demo purposes -->
 {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

 <script src="{{asset('js/global.js')}}"></script>

 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!--Select2 [ OPTIONAL ]-->
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

<!--Bootstrap Tags Input [ OPTIONAL ]-->
<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

{{-- morris chart --}}
{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    {{-- datepicker --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $('#attr_key').change(function (e) { 
       var _key = $(this).val();
       if(_key == 'size'){
        $('.value_attr').hide();
        $('.name_attr').show();
       }else{
        $('.value_attr').show();
        $('.name_attr').show();
       }
    });
</script>

<script>
    var stt = $( "#getIndex" ).val();

     $(document).ready(function () {
            $(document).on('click', '#add_more_item', function (e) {
                e.preventDefault();
                stt++;
                var outPut=`<div class="col-4">
                    <div class="panel-body name_attr">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>T??n bi???n th???</b></label>
                                <input type="text" class="form-control" name="attr_name[]" value="{{old('attr_name')}}">
                              
                            </div>
                        </div>
                        <div class="panel-body value_attr">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>Gi?? tr???</b></label>
                                <input type="color" name="attr_value[]" class="form-control" value="{{old('attr_value')}}">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>???nh</b></label> <br>
                                <input type="file" name="attr_img[]" data-val="${stt}" style="display: none" class="file">
                                <div class="input-group my-2">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file${stt}">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <img src="" id="previewImage${stt}" width="120px" style="max-height:100px alt="" class="mb-2">
                            </div>
                        </div>
                    </div>`;
                    $("#more_item").before(outPut);
            })
        });
</script>
{{-- <script>
    var stt = $( "#getIndex" ).val();

     $(document).ready(function () {
            $(document).on('click', '#add_more_item', function (e) {
                e.preventDefault();
                stt++;
                var outPut=`<div class="col-4">
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>T??n thu???c t??nh</b></label>
                                <input type="text" class="form-control" name="attr_name[]" value="{{old('attr_name')}}">
                                @error('attr_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>???nh</b></label> <br>
                                <input type="file" name="attr_img[]" data-val="${stt}" style="display: none" class="file">
                                <div class="input-group my-2">
                                    <input type="text" class="form-control" disabled placeholder="Upload file..." name="" id="file${stt}">
                                    <div class="input-group-append">
                                        <button type="button" class="browse btn btn-primary">Browse..</button>
                                    </div>
                                </div>
                                <img src="" id="previewImage${stt}" width="120px" style="max-height:100px alt="" class="mb-2">
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="mb-3">
                                <label for="" class="form-label"><b>M?? t???</b></label>
                                <textarea name="attr_desc[]" class="form-control" cols="30" rows="10">{{old('attr_desc')?old('attr_desc'):''}}</textarea>
                            </div>
                        </div>
                    </div>`;
                    $("#more_item").before(outPut);
            })
        });
</script> --}}

<script>

$(document).on("click", ".browse", function () {
    var file = $(this)
    .parent()
    .parent()
    .parent()
    .find(".file");
    file.trigger('click');
})

$(document).on('change', '.file', function (e) {
    var fileName = e.target.files[0].name;
    var id = $(this).attr("data-val");
    $('#file'+id).val(fileName);

    readURL(this, id);
})

function readURL(input, id) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewImage' + id).attr('src', reader.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

 <script>

      // alert success
      @if (session('success'))
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 1800
        })
    @endif

    // alert error
    @if (session('error'))
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 1800
        })
    @endif

     $(function() {
        $(document).on('click', '.btn-delete', function() {
            let formId = $(this).data('form')
            Swal.fire({
                title: 'B???n ch???c ch???n mu???n x??a?',
                text: "B???n s??? kh??ng th??? kh??i ph???c n??!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'C??, t??i ch???c ch???n!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${formId}`).submit();
                }
            })
        })
    });

      // confirm delete
      $(function() {
        $(document).on('click', '.btn-delete', function() {
            let formId = $(this).data('form')
            Swal.fire({
                title: 'B???n ch???c ch???n mu???n x??a?',
                text: "B???n s??? kh??ng th??? kh??i ph???c n??!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'C??, t??i ch???c ch???n!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${formId}`).submit();
                }
            })
        })
    });
 </script>



