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
     
        <form action="{{route('app-document.store')}}" method="POST"> 
          @method('post') 
          @csrf 
          <h3 class="text-center">{{trans('title.add_app_doc')}}</h3>
          <div class="modal-body">
            <div class="form-row">
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('title.doc_type')}}:</label>
                <select name="doc_type_id" class="form-control" required="">
                  <option value="" selected disabled hidden>Select Document Type</option> @foreach($doc_type as $type) <option value="{{$type->id}}">{{$type->name}}({{$type->name_en}})</option> @endforeach
                </select>
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('common.filename')}}:</label>
                <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter FileName" name="filename" required="">
              </div>
              <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{trans('common.date')}}:</label>
                <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Choose Date" name="date" required="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
            <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
          </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="" method="POST" id="editform" name="editform"> 
        @method('PATCH') 
        @csrf 
        <div class="modal-header">
          <div class="col-md-11 text-center">
            <h3 class="text-center">{{trans('title.update_app_doc')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label>{{trans('title.doc_type')}}</label>
              <select name="doc_type_id" class="form-control" required="">
                <option value="" selected disabled>Select Document Type</option> @foreach($doc_type as $type) <option value="{{$type->id}}">{{$type->name}}({{$type->name_en}})</option> @endforeach
              </select>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.filename')}}:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter FileName" name="filename" required="">
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">{{trans('common.date')}}:</label>
              <input type="text" class="date form-control" id="validationCustom01" value="" placeholder="Choose Date" name="date" required="">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
          <button type="submit" class="btn btn-success">{{trans('button.save')}}</button>
        </div>
      </form>
    </div>
  </div>
</div>