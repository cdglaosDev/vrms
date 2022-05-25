
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST"  id="editform" name="editform">
                @method('PATCH')
               @csrf
                <div class="modal-header">
                    <div class="col-md-11 text-center">
                        <h3 class="text-center">Edit Unit Price</h3>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                       
                         <div class="col-md-12 mb-3">
                <label for="validationCustom01">Province Code:</label>
                <input type="text" name="province_name" class="form-control" readonly>
                <input type="hidden" name="province_code" class="form-control" readonly>
               
              </div>
              
              <div class="col-md-12 mb-3">
                <label for="validationCustom01"> Price:</label>
                
                <input type="text" class="form-control"  value="" placeholder="Enter Price" name="unit_price" required="">
              </div>      
              <div class="col-md-12 mb-3">
                <label for="validationCustom01"> Fine Percent:</label>
                <input type="text" class="form-control"  value="" placeholder="Enter Fine percent" name="fine_percent" required="">
              </div>  
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Currency:</label>
                <select name="money_unit_id" id="" class="form-control">
                    @foreach($currency as $data)
                    <option value="{{ $data->id }}">{{$data->name}}</option>
                    @endforeach
                </select>
              </div>                  
            
                </div>
                </div>

                <div class="modal-footer">
                    
             <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
             <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>