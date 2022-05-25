<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.add_lic_alphabet') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        
            <form  action="{{route('license-alphabet.store')}}"  method="POST" id="newForm">
               @method('post')
               @csrf
               <div class="modal-body">
                  <div class="form-row">
                     <input type="hidden" id="new-id" value="">
                     <div class="col-md-12 mb-3">
                        <label for="validationCustom01">{{ trans('module4.alphabet') }}:</label>
                        <input type="text" class="form-control alphabet" maxlength="2" title="{{ trans('title.alert_license') }}" value="" placeholder="Enter Name" name="name" required="">
                     </div>
                     <div class="col-md-12 mb-3">
                        <label for="validationCustom01">{{ trans('module4.alphabet') }}(Eng):</label>
                        <input type="text" class="form-control alphabet_en" maxlength="2" title="" value="" placeholder="Enter Name" name="name_en" >
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <button type="submit" class="btn btn-success btn-sm" id="add-license">{{trans('button.save')}}</button>
               </div>
            </form>
      </div>
   </div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
            <div class="modal-header">
               
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{ trans('module4.edit_lic_alphabet') }}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <form action="" method="POST"  id="editform" name="editform">
            @method('PATCH')
            @csrf
            
            <div class="modal-body">
               <div class="form-row">
               <input type="hidden" id="edit-id" value="">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alphabet') }}:</label>
                     <input type="text" class="form-control  edit-alphabet" maxlength="2" title="{{ trans('title.alert_license') }}" value="" placeholder="Enter Name" name="name" required="">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{ trans('module4.alphabet') }}(Eng):</label>
                     <input type="text" class="form-control alphabet_en" maxlength="2" title="{{ trans('title.alert_license') }}" value="" placeholder="Enter Name" name="name_en">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm " id="edit-license">{{trans('button.update')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>