<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form  action="{{route('country.store')}}"  method="POST" id="addform">
            @method('post')
            @csrf
            <input type="hidden" id="new-id" value="">
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('table_man.add_country')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('table_man.iso')}}:</label>
                     <input type="text" class="form-control iso" New value="" placeholder="Enter Iso Name" name="iso" required="" title="{{trans('table_man.country_msg_iso')}}">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('table_man.country_name')}}:</label>
                     <input type="text" class="form-control name" New value="" placeholder="Enter Country name " name="name" required="" title="{{trans('table_man.country_msg_name')}}">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('table_man.country_namee')}}:</label>
                     <input type="text" class="form-control name_en" New value="" placeholder="Enter Country Name" name="name_en" required="" title="{{trans('table_man.country_msg_name_en')}}">
                  </div>
                  <div class="col-md-3 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control status">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <a  class="btn btn-success btn-sm btn-save" id="add-form">{{trans('button.save')}}</a>
            </div>
     
      </form>
   </div>
</div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
            @method('PATCH')
            @csrf
            <input type="hidden" id="edit-id" value="">
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('table_man.update_country')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('table_man.iso')}}:</label>
                     <input type="text" class="form-control iso" New value="" placeholder="Enter Iso Name" name="iso" required="" title="{{trans('table_man.country_msg_iso')}}">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('table_man.country_name')}}:</label>
                     <input type="text" class="form-control name" New value="" placeholder="Enter  Title" name="name" required="" title="{{trans('table_man.country_msg_name')}}">
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('table_man.country_namee')}}:</label>
                     <input type="text" class="form-control name_en" New value="" placeholder="Enter Name" name="name_en" required="" title="{{trans('table_man.country_msg_name_en')}}">
                  </div>
                  <div class="col-md-3 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control status">
                        <option value="1">{{trans('table.active')}}</option>
                        <option value="0">{{trans('table.deactive')}}</option>
                     </select>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
               <input type="submit" class="btn btn-success btn-sm btn-save" id="update-form" value="{{trans('table.update')}}">
            </div>
      
      </form>
   </div>
</div>
</div>
