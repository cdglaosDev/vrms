@php
$app_status = \App\Model\ApplicationStatus::whereStatus(1)->get();
@endphp
<div class="modal fade" id="approveModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form action="" method="POST"  id="approve_form" name="approveform">
            @method('POST')
            @csrf
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">Appove Application Form</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label>App status</label>
                     <select name="app_status_id" class="form-control">
                        @foreach($app_status as $status)
                        <option value="{{$status->id}}">{{ $status->name }}({{ $status->name_en }})</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">Remark:</label>
                     <textarea name="remark" id="" cols="4" rows="5" class="form-control"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-light btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm">{{trans('button.approve')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>