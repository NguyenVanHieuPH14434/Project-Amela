@extends('layouts.admin.master')
@section('title', 'Dashboard')
@section('titleContent', 'Dashboard')
@section('content')
{{-- <h1>Đây là trang Admin</h1> --}}

{{-- <div class="container-fluid"> --}}
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3 id="total_order">150</h3>

            <p>Đơn hàng</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3 id="total_product"><sup style="font-size: 20px"></sup></sup></h3>

            <p>Sản phẩm</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3 id="total_user"></h3>

            <p>Người dùng</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3 id="total_category"></h3>

            <p>Danh mục</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
     <div class="row ml-1">
      <form autocomplete="off" >
        <div style="display: flex; gap: 10px">
                    <input id="datepicker"
                        type="text" style="width: 120px" class="form-control"
                        placeholder="Ngày bắt đầu" />
                    <span style="padding-top: 5px">to</span> 
                    <input id="datepicker2"
                        type="text" placeholder="Ngày kết thúc" style="width: 120px" class="form-control"/>
               
                    <select id="changeFillter" style="width: 120px" class="form-control">
                        <option value="">Chọn ngày</option>
                        <option value="today">Hôm nay</option>
                        <option value="7">7 Ngày trước</option>
                        <option value="14">14 Ngày trước</option>
                        <option value="30">30 Ngày trước</option>
                        <option value="60">60 Ngày trước</option>
                        <option value="90">90 Ngày trước</option>
                        <option value="365">365 Ngày trước</option>
                    </select>
                    <a href=""><button class="btn btn-primary _btn_send_data">Lọc</button></a>
            </div>

    </form>
   
    </div>
    <div class="row">

        {{-- <div id="myfirstchart" class="col-12"></div> --}}
        <div id="myfirstchart" class="col-12" style="height: 278px; padding: 0px;
        position: relative;"></div>
      <!-- Left col -->

      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  {{-- </div> --}}
@endsection
@section('page-js')

<script >
  $(document).ready(function () {
      $('#changeFillter').on('change', function (e) {
          e.preventDefault();
          var dateChange = $(this).val();
          var now = new Date();
          var to = new Date().toJSON().slice(0, 10);
          if(dateChange == 'today'){
              from = to
          }else{
              var from = new Date(now.setDate(now.getDate() - dateChange)).toJSON().slice(0, 10);
          }
          $.ajax({
            url: "{{route('chart')}}",
              type: "get",
              headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
              dataType: "JSON",
              data: {date_from:from, date_to:to},
              success: function (data) {
                  chart.setData(data.orderFilter)
              }
          });
       });
       $('._btn_send_data').on('click', function (e) {
          e.preventDefault();
          var now = new Date().toJSON().slice(0, 10);
          var _token = $('input[name="_token"]').val();
          var date_from = $('#datepicker').val()
          var date_to = $('#datepicker2').val()
          var from = now;
          var to = now;
          if(date_from && date_to){
              from = date_from;
              to = date_to;
          }
          else if(date_from && !date_to){
              from = date_from
              to = date_from
          }
          $.ajax({
            url: "{{route('chart')}}",
              type: "get",
              headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
              dataType: "JSON",
              data: {date_from:from, date_to:to},
              success: function (data) {
                  chart.setData(data.orderFilter)
              }
          });
      });
      defaultStatistic();
      var chart =  new Morris.Area({
      element: 'myfirstchart',
      lineColors:['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
      pointFillColors: ['#ffffff'],
      pointStrokeColors:['black'],
      fillOpacity:0.6,
      hiddeHover:'auto',
      parseTime: false,
      xkey: 'date',
      ykeys: ['total'],
      behaveLikeLine:true,
      labels: ['Số đơn hàng']
      });
     
      function defaultStatistic() {
          var now = new Date();
          var from = new Date(now.setDate(now.getDate() - 365)).toJSON().slice(0, 10);
          var to = new Date().toJSON().slice(0, 10);
        
          $.ajax({
              url: "{{route('chart')}}",
              type: "get",
              dataType: "JSON",
              data: {date_from:from, date_to:to},
              success: function (data) {
                  chart.setData(data.orderFilter)
                  $("#total_product").html(data.product.total);
                  $("#total_category").html(data.category.total);
                  $("#total_order").html(data.order.total);
                  $("#total_user").html(data.user.total);
                  console.log(data.user);
                
              }
          });
      };
  });
  </script>
  <script>
      var option = {
          prevText:"Tháng trước",
          nextText:"Tháng sau",
          dayNamesMin:['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ nhật'],
          dateFormat:"yy-mm-dd"
      }
      $('#datepicker').datepicker(option);
      $('#datepicker2').datepicker(option);
  </script>
@endsection
