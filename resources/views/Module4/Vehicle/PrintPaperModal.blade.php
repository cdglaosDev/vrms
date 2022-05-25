@php 
$app_type = \App\Model\ApplicationType::whereStatus(1)->get();
@endphp
<div class="modal fade" id="PrintPaper2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ url('new-appform',$vehicle_id) }}" method="POST"  id="printpaper2" name="paper">
                @method('POST')
               @csrf
                <div class="modal-header">
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-row">
                    <h3 class="text-center">Please select One of these options</h3>

                    <div class="col-md-12 mb-3">
                    <select name="app_type_id" id=""  class="form-control" required>
                        @foreach($app_type as $type)
                        <option value="{{$type->id}}">{{ $type->name }}({{$type->name_en}})</option>
                        @endforeach
                    </select>
                    </div>    
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">Remark:</label>
                    <textarea name="remark" id="" cols="4" rows="5" class="form-control"></textarea>
                    <input type="hidden" name="type"  value="paper2" >
                </div>      
                </div>
                <div class="row p-1">
                <div class="col-md-6 ">
                <button type="button" data-dismiss="modal" class="btn btn-light btn-sm">Back</button>
                
                </div>
                <div class="col-md-6 text-right">
                <button type="submit" name="paper2" class="btn btn-success  btn-sm">Print and Save</button>
                
                </div>
                </div>
                </div>
               
            </form>
        </div>
    </div>
</div>