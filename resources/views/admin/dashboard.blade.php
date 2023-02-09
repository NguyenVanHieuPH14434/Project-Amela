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
            <h3>150</h3>

            <p>New Orders</p>
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
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
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
            <h3>44</h3>

            <p>User Registrations</p>
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
            <h3>65</h3>

            <p>Unique Visitors</p>
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

        <div id="myfirstchart" class="col-12"></div>
      <!-- Left col -->

      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  {{-- </div> --}}
@endsection
@section('page-js')
<script>
    new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>
@endsection
