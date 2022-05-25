<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('module4.add_lic_alphabet_control')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('license-alphabet-control.store')}}" method="POST" id="addform">
            @method('post')
            @csrf
            <input type="hidden" id="new-id" value="">
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">Alphabet Control Status:</label>
                     <input type="text" class="form-control name" value="" placeholder="{{trans('table_man.lic_alp_ctrl_enter_status')}}" name="name" required="" title="{{trans('table_man.lic_alp_ctrl_msg_status')}}">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="add-form">{{trans('button.save')}}</button>
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
               <h3 class="text-center">{{trans('module4.edit_lic_alphabet_control')}}</h3>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="" method="POST" id="editform" name="editform">
            @method('PATCH')
            @csrf
            <input type="hidden" id="edit-id" value="">
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">Alphabet Control Status:</label>
                     <input type="text" class="form-control name" value="" placeholder="{{trans('table_man.lic_alp_ctrl_enter_status')}}" name="name" required="" title="{{trans('table_man.lic_alp_ctrl_msg_status')}}">
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit" class="btn btn-success btn-sm" id="edit-form">{{trans('button.update')}}</button>
            </div>
         </form>
      </div>
   </div>
</div>