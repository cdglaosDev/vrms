@extends('customer.layouts.master')
@section('dash','active')
@section('title','Dashboard')
@section('content')
<link rel="stylesheet" href="path-to/node_modules/perfect-scrollbar/dist/css/perfect-scrollbar.min.css" />
<div class="row mt-3 customer-dashboard">
   <div class="col-md-6 col-lg-3 grid-margin stretch-card">
      <div class="card bg-primary text-center text-white">
         <h6 class="font-weight-normal">{{trans('customer.total_app')}}</h6>
         <div id="total_app">
            <h2 class="mb-0">{{$app->count()}}</h2>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-3 grid-margin stretch-card">
      <div class="card bg-success text-center text-white">
         <h6 class="font-weight-normal">{{trans('customer.progress_app')}}</h6>
         <div id="in_progress">
            <h2 class="mb-0">{{$in_progress->count()}}</h2>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-3 grid-margin stretch-card">
      <div class="card bg-warning text-center text-white">
         <h6 class="font-weight-normal">{{trans('customer.approved_app')}}</h6>
         <div id="approve">
            <h2 class="mb-0">{{$approve->count()}}</h2>
         </div>
      </div>
   </div>
   <div class="col-md-6 col-lg-3 grid-margin stretch-card">
      <div class="card bg-info text-center text-white">
         <h6 class="font-weight-normal">{{trans('customer.reject_app')}}</h6>
         <div id="reject">
            <h2 class="mb-0">{{$reject->count()}}</h2>
         </div>
      </div>
   </div>
</div>
<div class="row mt-5">
   <div class="col-md-7">
      <h4>{{trans('customer.latest_import_list')}}</h4>
      <div class="table-responsive">
         <table class="table table-striped">
            <thead>
               <tr>
                  <th>{{trans('app_form.pre_app_no')}}</th>
                  <th>{{trans('module4.owner_name')}}</th>
                  <th>{{trans('common.status')}}</th>
                  
               </tr>
            </thead>
            <tbody>
               @foreach ($latest_app as $item)
               <tr>
                  <td>{{$item->regapp_number??''}}</td>
                  <td>{{$item->vehicle_detail->owner_name??''}}</td>
                  @if($item->app_status_id ==4)
                  <td><label class="badge badge-success">Approved</label></td>
                  @elseif($item->app_status_id ==5)
                  <td><label class="badge badge-danger">Rejected</label></td>
                  @elseif($item->app_status_id == 3)
                  <td><label class="badge badge-warning">In progress</label></td>
                  @elseif($item->app_status_id == 6)
                  <td><label class="badge badge-primary">Draft</label></td>
                  @elseif($item->app_status_id == 1)
                  <td><label class="badge badge-info">Complete</label></td>
                  @elseif($item->app_status_id == 2)
                  <td><label class="badge badge-secondary">Cancel</label></td>
                  @endif
                  
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
   <div class="col-md-5">
      <div class="card-body">
         <h4 class="card-title">{{trans('customer.app_chat')}}</h4>
         <div id="traffic-chart-legend" class="chartjs-legend traffic-chart-legend">
            <ul class="0-legend">
               <li>
                  <div class="legend-content"><span class="legend-dots" style="background-color:rgb(255, 149, 87, 0.8)"></span>{{ trans('button.in_progress') }}</div>
               </li>
               <li>
                  <div class="legend-content"><span style="background-color:rgb(216, 82, 244, 0.8)"></span>{{ trans('button.approve') }}</div>
               </li>
               <li>
                  <div class="legend-content"><span style="background-color:rgba(255, 94, 94, 1)"></span>{{ trans('button.reject') }}</div>
               </li>
            </ul>
         </div>
         <br><br>
         <canvas id="doughnutChart"></canvas>
         <div class="text-center mt-5">
            <h4 class="mb-2">
            Application By Status</h5>
            <p class="card-description mb-5">Application shown by the status of In progress,Approved and Rejected</p>
         </div>
      </div>
   </div>
</div>
<div class="col-lg-8 grid-margin stretch-card">
</div>
</div>
@endsection 
@push('page_scripts')
<script src="path-to/node_modules/chart.js/dist/Chart.min.js"></script>
<script type="text/javascript">
   $(function() {
    
     'use strict';
     
     var in_progress = document.getElementById('in_progress').innerText;
     var approve = document.getElementById('approve').innerText;
     var reject = document.getElementById('reject').innerText;
     var total_app = document.getElementById('total_app').innerText;
     var doughnutPieData = {
         datasets: [{
         data: [in_progress, approve, reject],
         backgroundColor: [
           'rgb(255, 149, 87, 1)',
           'rgb(216, 82, 244, 1)',
           'rgba(255, 94, 94, 1)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)'
         ],
         borderColor: [
           'rgb(255, 149, 87, 1)',
           'rgb(216, 82, 244, 1)',
           'rgba(255, 94, 94, 1)',
           'rgba(54, 162, 235, 1)',
           'rgba(255, 206, 86, 1)',
           'rgba(75, 192, 192, 1)',
           'rgba(153, 102, 255, 1)',
           'rgba(255, 159, 64, 1)'
         ],
       }],
   
       //These labels appear in the legend and in the tooltips when hovering different arcs
       labels: [
         'In Progress',
         'Approved',
         'Rejected',
       ]
     };
     var doughnutPieOptions = {
       responsive: true,
       animation: {
         animateScale: true,
         animateRotate: true,
       },
       cutoutPercentage: 80,
       legend: {
           display: false
       },
     };
   
     if ($("#doughnutChart").length) {
       var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
       var doughnutChart = new Chart(doughnutChartCanvas, {
         type: 'doughnut',
         data: doughnutPieData,
         options: doughnutPieOptions
       });
     }
   });
   
</script>
@endpush