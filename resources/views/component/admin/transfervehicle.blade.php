<div class="modal fade" id="addModel1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="{{route('transfer_vehicle.store')}}"  method="POST">
                  @method('post')
                  @csrf
                  
          <h3 class="text-center">Create New Transfer Vehicle</h3>
          <div class="modal-body">
            <div class="form-row">
            	 <div class="col-md-12 mb-3">
                <label for="validationCustom01">App Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter App Number " name="app_number" required="">
              </div>
             
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Transfer From:</label>
                <select name="transer_from" class="form-control">
                    <option value="" selected disabled hidden>-- Select Transfer From-- </option>
                    @foreach($province as $key=>$value)
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Transfer To:</label>
                <select name="transer_to" class="form-control" required="">
                     <option value="" selected disabled hidden>-- Select Transfer To-- </option>
                    @foreach($province as $key=>$value)
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Old Vehicle Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Old Vehicle Number " name="old_vehicle_number" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">New Vehicle Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District New Vehicle Number " name="new_vehicle_number" required="">
              </div>
            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Date:</label>
                                           <input type="text" name="date" class="date form-control" placeholder="Choose Date">    
                                    </div>
                                </div>
                               
      {{--    <div class="col-md-8 mb-3">
								<label for="validationCustom01">Date</label>
									<div class="col-md-8">
										<div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
											<input type="text" name="date"  class="form-control" placeholder="Select Date" />
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
								</div> --}} 
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Remark:</label>
                <textarea name="remark" rows="3" class="form-control" placeholder="Enter District Description"></textarea>
              </div>
             
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">Apply By:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Apply By Only Integer Value " name="apply_by" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Approved Officer:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Approve Officer Only Integer Value " name="approved_officer" required="">
              </div>
             
               @error("Note")
        <small class="text-primary">{{collect($errors->get("province_id"))->implode(",")}}</small>
        @enderror
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Status:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                </select>
              </div>
              
                  </div>
                </div>
              <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                <button type="submit"  class="btn btn-success btn-sm btn-save">{{trans('button.save')}}</button>
             </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

 <div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
      
            <form action="" id="deleteform" method="POST">
                  @method('Delete')
                  @csrf             
            <div class="modal-body">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
               <h1 class="text-center">
                  <i class="zmdi zmdi-alert-circle-o zmdi-hc-fw"></i>
               </h1>
               <div class="modal-body text-center">
                  <h4>Are you sure?</h4>
                  <p>Do you really want to delete this record?</p>
               </div>
               <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary ">Cancel</button>
                  <input type="submit" class="btn btn-danger "  value="Delete">

               </div>
            </div>
        
        </form>
      </div>
   </div>
</div>
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form enctype="multipart/form-data" action="" id="editform" name="editform" method="POST">
                 
                  @method('PATCH')
                  @csrf
                  
          <h3 class="text-center">Update Transfer Vehicle</h3>
          <div class="modal-body">
            <div class="form-row">
             
                     <div class="col-md-12 mb-3">
                <label for="validationCustom01">App Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District Name_En " name="app_number" required="">
              </div>
             
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Transfer From:</label>
                <select name="transer_from" class="form-control">
                    <option value="0" disabled="disabled">None</option>
                    @foreach($province as $key=>$value)
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Transfer To:</label>
                <select name="transer_to" class="form-control">
                    <option value="0" disabled="disabled">None</option>
                    @foreach($province as $key=>$value)
                        <option value={{$value}}> {{$key}} </option>
                    @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Old Vehicle Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District Name " name="old_vehicle_number" required="">
              </div>
             <div class="col-md-12 mb-3">
                <label for="validationCustom01">New Vehicle Number:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District Name_En " name="new_vehicle_number" required="">
              </div>
            <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Date:</label>
                                           <input type="text" name="date" class="date form-control" placeholder="Choose Date">    
                                    </div>
                                </div>
                               
      {{--    <div class="col-md-8 mb-3">
                <label for="validationCustom01">Date</label>
                  <div class="col-md-8">
                    <div class="input-group date" id="datepicker-disabled-past" data-date-format="dd-mm-yyyy" data-date-start-date="Date.default">
                      <input type="text" name="date"  class="form-control" placeholder="Select Date" />
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div> --}} 
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Remark:</label>
                <textarea name="remark" rows="3" class="form-control" placeholder="Enter District Description"></textarea>
              </div>
             
               <div class="col-md-12 mb-3">
                <label for="validationCustom01">Apply By:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District Name_En " name="apply_by" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Approved Officer:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter District Name_En " name="approved_officer" required="">
              </div>
             
               @error("Note")
        <small class="text-primary">{{collect($errors->get("province_id"))->implode(",")}}</small>
        @enderror
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">Status:</label>
                <select name="status" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                </select>
              </div>
              3
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                  <input type="submit" class="btn btn-success " value="Save">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
