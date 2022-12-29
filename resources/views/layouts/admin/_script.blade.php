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

 <script>
     $(function() {
        $(document).on('click', '.btn-delete', function() {
            let formId = $(this).data('form')
            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa?',
                text: "Bạn sẽ không thể khôi phục nó!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có, tôi chắc chắn!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#${formId}`).submit();
                }
            })
        })
    });
 </script>
