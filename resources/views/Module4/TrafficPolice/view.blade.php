{{-- @extends('layouts.master')
@section('vims','active')
@section('title','Traffic Police')
@section('content')
<style>
    .table-icontable td {
        border-collapse: collapse;
        border: none !important;
    }
    .table-icontable tr td {
    padding-top: 0;
    }
</style>
<h1 class="page-header">{{ trans('Detail Of Traffic Accidence') }}</h1>
  
@endsection --}}

<div class="modal fade" id="viewModel{{$traffic->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <form method='post' action='' enctype='multipart/form-data' id="viewform" name="viewform">
        @method('PATCH')
          {{ csrf_field() }}
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel-2" style="text-align: center"><b>Detail Of Traffic Accidence</b></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.division_number')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->division_no ?? ''}}" name="division_no" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('common.date')}}:</label>
                            <input type="text" class="date form-control" value="{{ $traffic->date?? ''}}" name="date" readonly>
                        </div> 
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.license_no')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->license_no?? ''}}" name="license_no" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.place')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->place?? ''}}" name="place" readonly>
                        </div>  
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.brand')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->brand->name ?? ''}}" name="brand_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.offender')}}:</label>
                            <input type="text" class="date form-control" id="validationCustom01" value="{{ $traffic->offender_name?? ''}}" name="offender_name" readonly>
                        </div> 
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.model')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->model->name ?? ''}}" name="model_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.officer')}}:</label>
                            <input type="text" class="date form-control" id="validationCustom01" value="{{ $traffic->officer_name?? ''}}" name="officer_name" readonly>
                        </div> 
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.color')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->color->name ?? ''}}" name="color_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('common.status')}}:</label>
                            @if(isset($traffic))
                            @if($traffic->status == "1")
                            <input type="text" class="form-control" id="validationCustom01" value="Active" readonly>
                            @elseif($traffic->status == "0")
                            <input type="text" class="form-control" id="validationCustom01" value="Deactive" readonly>
                            @endif
                        @else
                            <input type="text" class="form-control" id="validationCustom01" value="" readonly>
                        @endif
                        </div> 
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.vehicle_type')}}:</label>
                            <input type="text" class="form-control" id="validationCustom01" value="{{ $traffic->vehicle_type->name ?? ''}}" name="vehicle_type_id" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="validationCustom01">{{ trans('module4.note')}}:</label>
                            <input type="text" class="date form-control" id="validationCustom01" value="{{ $traffic->remark?? ''}}" name="remark" readonly>
                        </div> 
                    </div>
                </div>

                @php
                    $charges = array();
                    if(isset($traffic)){
                    foreach($value->illegal_trafic_acc as $item)
                    $charges[] = $item->traffic_accident->id;
                }else{
                    $charges[] = null;
                }
               
                @endphp
                <div class="col-md-8">
                <h5 style="text-align: center;font-weight: bold;">Charges</h5>
                @foreach($traffic_accidence->chunk(3) as $chunked_accidence)
                        <div class="row">
                            @foreach( $chunked_accidence as $dealAccidence )
                                <div class="col-md-4">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="accident_id[]" class="form-check-input" value="{{$dealAccidence->id}}" {{ in_array($dealAccidence->id, $charges) ?'checked':''}} readonly>
                                        {{$dealAccidence->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm btn_cancel" data-dismiss="modal">{{ trans('button.cancel')}}</button>
        </div>
      </form>  
      </div> 
    </div>
  </div>

@push('page_scripts')
<script type="text/javascript">
    $(document).on("click", '.btn_cancel', function (e) {  
        location.reload();
        return false;
    }); 
</script>
@endpush