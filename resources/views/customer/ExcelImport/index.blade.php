@extends('customer.layouts.master')
@section('vehicle','active')
@section('title','Import Vehicle Excel')
@section('content')
<h3>{{ trans('app_form.app_doc') }}</h3>
@if(!empty(session('duplicate_data')))
   <p class="alert alert-danger">{{ trans('importer.import_status') }}</p>
@else
   <p class="alert alert-info">Import Data Success.</p>
@endif
@include('flash');
<div class="card-body">
  
   <div class="table-responsive">
      <table class="table table-striped ImportTable"  id="myTable">
         <thead>
            <tr>
               <th> {{ trans('app_form.pre_licence_no') }}</th>
               <th>{{ trans('vehicle.owner_name') }}</th>
               <th>{{ trans('vehicle.brand') }}</th>
               <th>{{ trans('vehicle.model') }}</th>
               <th>{{ trans('common.action') }}</th>
            </tr>
         </thead>
         @if(!empty(session('vehicle_id')))
            @foreach(session('vehicle_id') as $vehicle)
               @php
               $vehicle_detail = \App\Model\VehicleDetail::whereId($vehicle['vehicle_id'])->select('id', 'licence_no_need','owner_name', 'brand_id','model_id')->get();
               @endphp
               @foreach($vehicle_detail as $detail)
               <tr>
                  <td>{{ $detail['licence_no_need'] }}</td>
                  <td>{{ $detail->owner_name }}</td>
                  <td>{{ $detail->brand->name ?? '' }}</td>
                  <td>{{ $detail->model->name ?? '' }}</td>
                  <td><a data-url="{{ url('/customer/attach-document-import',['id'=>$detail->id])}}" data-id="{{ $detail->id }}" data-license_no_need="{{ $detail->licence_no_need}}" class="btn btn-info show_btn attach" data-backdrop="static" data-keyboard="false"  data-toggle="modal"  data-target="#showModal" >Attach Document</a></td>
               </tr>
               @endforeach
            @endforeach
         @endif
      </table>
      <a href="{{url('/customer/vehicle-detail')}}" class="btn btn-secondary btn-sm">{{ trans('button.back') }}</a>

      @if(!empty(session('duplicate_data')))
         <h5 style="color:red">Duplicate Data following:</h5>
            @foreach(session('duplicate_data') as $index=>$data)
               <span>{{ $index+1 }}.({{ $data['engine_no'] }} and {{ $data['chassis_no'] }})</span>
            @endforeach
      @endif
      <!--start Excel import modal -->
   </div>
 
</div>
<!-- start show modal popup -->
<div class="modal fade" id="showModal" role="dialog">
   <div class="modal-dialog modal-lg" >
      <!-- Modal content-->
      <div class="modal-content show-modal" >
      </div>
   </div>
</div>
@endsection
@push('page_scripts')
<script>
    //clear input file when click "X" for attached document
   $(document).on('click', '.remove', function(e){  
   e.preventDefault();
   $(this).closest("tr").find("td:eq(1) .filename").val('');
   $(this).closest("tr").find("td:eq(1) .filename_image").text('');
   $(this).closest("tr").find("td:eq(1) .old_file").val(0);
   }); 
</script>
<script src="{{ asset('vrms2/js/filevalidate.js') }}"></script>
<script src="{{ asset('vrms2/js/showModal.js')}}"></script>
@endpush