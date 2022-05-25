@extends('layouts.master')
@section('vims','active')
@section('content') 
<style>
  #order-listing_filter{
  display: none;
}
</style>
    <h1 class="page-header"> {{ trans('module4.vehicle_list')}}</h1>
    <div class="card">
    <div class="card-body">
    @include('flash')
      <!-- <div class="col-md-6 offset-md-9">
      <form action="{{url('search-licence')}}" method="get" class="mb-3">
            
            <div class="form-row">
                        
            <div class="col-md-4 col-sm-4">
            <input type="text" name="q" class="form-control" placeholder="Enter Licence Number">
            <input type="hidden" name="page" value="vehicle">
            </div>
            <div class="col-md-3 col-sm-3">
            <input type="submit" class="btn btn-primary btn-sm"  value="Search">
            
            </div>
        </div>
        </form>
      </div> -->
      <div class="table-responsive" id="table_data">
      <table id="mytable" class="table dataTable  table-bordered data-table">
            <thead>
              <tr>
                <th>{{ trans('module4.no')}}</th>
                <th>{{ trans('module4.license_no')}}</th>
                <th>{{ trans('module4.owner_name')}}</th>
                <th>{{ trans('module4.village_name')}}</th>
               <th>{{ trans('common.province')}}</th>
               <th>{{ trans('module4.brand')}}</th>
              <th>{{ trans('common.action')}}</th>
                
              </tr>
        </thead>
        <tbody>
           
        </tbody>
      </table>
     
      </div>
        
        </div>
      </div>

@endsection
@push('page_scripts')
<script>
$(function() {
  $('#mytable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! route('vehicleList') !!}',
    columns: [
      { data: 'id', name: 'id','visible': false },
      {  data : 'licence_no',
          render : function(data, type, row) {
            if(data){
              return '<span>'+data+'</span>'
            }else{
              return null;
            }
              
          }    
       },
      { data: 'owner_name', name: 'owner_name' },
      { data: 'village_name', name: 'village_name' },
      { data: 'province', name: 'province.name' },
      { data: 'vbrand', name: 'vbrand.name' },
      { data: 'action', name: 'action' ,'orderable': false},
     
    ],createdRow: function( row, data, dataIndex ) {
      if(data.vehicle_kind_code ==2 ||data.vehicle_kind_code ==5 ||data.vehicle_kind_code ==8){
        $( row ).find('td:eq(0)>span').addClass('Vehkind1');
      }else if(data.vehicle_kind_code ==1){
        $( row ).find('td:eq(0)>span').addClass('Vehkind2');
      }else if(data.vehicle_kind_code ==3){
        $( row ).find('td:eq(0)>span').addClass('Vehkind3');
      }else if(data.vehicle_kind_code ==4){
        $( row ).find('td:eq(0)>span').addClass('Vehkind4');
      }else if(data.vehicle_kind_code ==6){
        $( row ).find('td:eq(0)>span').addClass('Vehkind5');
      }else{
        $( row ).find('td:eq(0)>span').addClass('');
      }
       
    }
  });
});
</script>
@endpush


