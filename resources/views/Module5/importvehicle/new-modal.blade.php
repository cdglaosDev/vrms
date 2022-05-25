
<div class="modal fade" id="newModal"   role="dialog"   aria-hidden="true">
   <div class="modal-dialog modal-xl" role="document" style="position: fixed;top: -28px;display: block;left: 82px;">
      <div class="modal-content mod5">
         <div class="modal-header ui-draggable-handle" style="border-bottom:none; padding:1.15rem 1rem">
            <h3 style="margin-top:-8px; font-size: 19px; border-bottom:none">
               {{ trans('module4.vehicle_title')}}
               <ul class="nav nav-tabs pt-2" style="width: 104%">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="tab" aria-current="page" href="#vehicleInfo1">{{ trans('module4.vehicle_info') }}</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#document1">{{ trans('module4.document') }}</a>
                  </li>
                
               </ul>
            </h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body pt-0">
            <div class="tab-content clearfix">
               <div class="tab-pane active" id="vehicleInfo1">
               <form id="newVeh" action="" method="POST">
               <input type="hidden" id="csrf" value="<?php echo csrf_token(); ?>">
               <input type="hidden"  class="pre_app_id" value="">
               <input type="hidden"  id="exist_vehicle_id" value="">
               @include('Module5.importvehicle.info',['data' => $data])
               <div class="col-md-3" style="float:right">
                  <a  class="btn btn-success btn-sm btn-save  save-draft draftBtn"  name="save_type" value="draft">{{ trans('button.save_draft')}}</a> &nbsp; 
                  <a  class="btn btn-success btn-sm  btn-save save-submit submitBtn" id="submitBtn"  name="save_type" value="submit">{{ trans('button.submit')}}</a>
                  <a  class="btn btn-success btn-sm  btn-save  disabled approveBtn"  name="save_type" >{{ trans('button.approve')}}</a>
                  <a href="{{url('/import-vehicle')}}" class="btn btn-secondary btn-sm mt-1">{{ trans('button.cancel')}}</a>
               </div>
               </form>
               </div>
               <div class="tab-pane" id="document1">
                  <form id="myForm" action="" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="vehicle_id" class="vehicle_id" value="">
                 
                  @include('Module5.importvehicle.doc-form')
                 
                  </form>
               </div>
               
            </div>
         </div>
      </div>
   </div>
</div>

@push('page_scripts')

<script type="text/javascript">
   var dist_url= "{{url('/getdistrict/')}}";
   var get_vmodal= "{{url('/getVmodel/')}}";
   var reject_url = "{{url('reject-app')}}";
   var addImport = "{{url('import-vehicle')}}";
   var addDoc = "{{ url('/add-attach-document')}}";
   // var addTenant = "{{ url('/detail-tenant') }}";
   
   //clear input file when click "X" for attached document
   $(document).on('click', '.remove', function(e){  
      e.preventDefault();
      $(this).closest("tr").find("td:eq(1) .filename").val('');
   }); 
 
</script>

<script src="{{ asset('vrms2/js/save-import.js') }}"></script>
<script src="{{ asset('vrms2/js/numvalidate.js') }}"></script>
<script type="text/javascript" src="{{asset('vrms2/js/dropdownlist.js')}}"></script>
<script src="{{ asset('vrms2/js/filevalidate.js') }}"></script>
<script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>


@endpush