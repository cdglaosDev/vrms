<form method='post' action="{{ url('/attach-document',$id) }}" id="myForm"  enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="modal-header">
         <div class="col-md-11 text-center">
            <h3 class="text-center">Attach{{ trans('app_form.app_doc')}} </h3>
         </div>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <!-- app document modal for staff side and customer side -->
         @include('Module5.ExcelImport.documentModal',['app_doc'=> $app_doc, 'pre_lic'=> $pre_lic, 'pre_app_no'=> $pre_app_no])
         <div class="col-md-12 text-right mt-3">
            <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
            <button type="submit" class="btn btn-success btn-sm " onClick="return validate()">{{trans('button.save')}}</button>
         </div>
      </div>
</form>
   