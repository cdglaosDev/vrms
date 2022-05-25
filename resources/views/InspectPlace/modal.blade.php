<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form  action="{{route('inspect-place.store')}}"  method="POST" id="addform">
            @method('post')
            @csrf
                <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">Add New Inspect Place</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>  
            
                <div class="modal-body">
                    <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01"> {{trans('table.namel')}}:</label>
                        <input type="text" class="form-control name"  value="" placeholder="Enter Inspect Place Name (lao)" name="name" required="" title="{{trans('table_man.inspect_place_msg_name')}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="validationCustom01"> {{trans('table.namee')}}:</label>
                        <input type="text" class="form-control name_en"  value="" placeholder="Enter Inspect Place Name (eng)" name="name_en" required="" title="{{trans('table_man.inspect_place_msg_name_en')}}">
                    </div>
                        <div class="col-md-3 mb-3">
                        <label for="validationCustom01">{{trans('table.status')}}:</label>
                        <select name="status" class="form-control">
                                <option value="1">{{trans('table.active')}}</option>
                                <option value="0">{{trans('table.deactive')}}</option>
                        </select>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                    <button type="submit"  class="btn btn-success btn-sm btn-save" id="add-form">{{trans('button.save')}}</button>
                </div>
            </form>
        </div>
      </div>
    </div>
 
 <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST"  id="editform" name="editform">
                @method('PATCH')
               @csrf
                <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">Update Inspect Place</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01"> {{trans('table.namel')}}:</label>
                            <input type="text" class="form-control name"  name="name" placeholder="Enter Inspect Place Name (lao)" required="" value="" title="{{trans('table_man.inspect_place_msg_name')}}">
                        </div>
                           <div class="col-md-12 mb-3">
                            <label for="validationCustom01">{{trans('table.namee')}}:</label>
                            <input type="text" class="form-control name_en" name="name_en" placeholder="Enter Inspect Place Name (eng)" required="" title="{{trans('table_man.inspect_place_msg_name_en')}}">
                        </div>                       
                       <div class="col-md-3 mb-3">
                            <label for="validationCustom01">{{trans('table.status')}}:</label>
                            <select name="status" class="form-control">
                                    <option value="1">{{trans('table.active')}}</option>
                                    <option value="0">{{trans('table.deactive')}}</option>
                            </select>
                        </div>
                    </div>
                </div>
               <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
                    <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('table.update')}}" id="edit-form">
                </div>
            </form>
        </div>
    </div>
</div>

    