@php
$doc_type = \App\Model\ApplicationDocType::get();
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
        <form  action="{{route('addDocument')}}"  method="POST" enctype="multipart/form-data">
                  @method('post')
                      @csrf
          <h3 class="text-center">Add vehicle document</h3>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('title.doc_type')}}:</label>
                <select name="doc_type_id" class="form-control" required="">
                  <option value="" selected disabled hidden>Select Document Type</option>
                  @foreach($doc_type as $type)
                  <option value="{{$type->id}}">{{$type->name}}({{$type->name_en}})</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('common.filename')}}:</label>
                <input type="file" class="form-control" id="validationCustom01" value="" placeholder="Enter FileName" name="filename" required="">
                <input type="hidden" name="vehicle_id" value="{{$vehicle_id}}">
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
