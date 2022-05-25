@php
$app_type = \App\Model\ApplicationType::whereStatus(1)->get();

@endphp
  <div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  action="{{url('store-app-form-detail')}}"  method="POST">
                  @method('post')
                      @csrf
          <h3 class="text-center">Add Application form detail</h3>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Application Type:</label>
                <select name="app_type_id" class="form-control">
                  <option value="" selected disabled>Select App Type</option>
                  @foreach($app_type as $type)
                  <option value="{{$type->id}}">{{ $type->name}}</option>
                  @endforeach
                </select>
              </div>
              <input type="hidden" name="app_form_id" value="{{ $app_form_id}}">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">Note:</label>
                <textarea name="detail_note" id="" cols="10" rows="5" class="form-control" name="detail_note"></textarea>
               </div>
             
             
            </div>
          </div>
          <div class="modal-footer">
            
           
          
            <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
             <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
            
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>