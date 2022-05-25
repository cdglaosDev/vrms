@php
$dept = \App\Model\Department::whereStatus(1)->get();
@endphp
<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="text-center">{{trans('title.add_display_setting')}}</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('display-setting.store')}}" method="POST">
        @method('post')
        @csrf
        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-1">
              <label for="validationCustom01"> Department:</label>
              <select name="department_id" class="form-control" required="">
                <option value="" selected disabled hidden>Select Department</option>
                @foreach($dept as $data)
                <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text One:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text One" name="text1" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text Two:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text Two" name="text2" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text Three:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text Three" name="text3" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Title:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Title" name="title" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="" selected disabled hidden>Select Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
          <button type="submit" class="btn btn-success btn-sm">{{trans('button.save')}}</button>
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
            <h3 class="text-center">{{ trans('title.update_display_setting')}}</h3>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-row">
            <div class="col-md-12 mb-1">
              <label>Department</label>
              <select name="department_id" class="form-control" required="" disabled>
                <option value="" selected disabled>Select Department</option>
                @foreach($dept as $data)
                <option value="{{$data->id}}">{{$data->name}}({{$data->name_en}})</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text One:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text One" name="text1" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text Two:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text Two" name="text2" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Text Three:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Text Three" name="text3" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">Title:</label>
              <input type="text" class="form-control" id="validationCustom01" value="" placeholder="Enter Title" name="title" required="">
            </div>
            <div class="col-md-12 mb-1">
              <label for="validationCustom01">{{trans('common.status')}}:</label>
              <select name="status" class="form-control">
                <option value="" selected disabled hidden>Select Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
              </select>
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