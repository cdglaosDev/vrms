<div class="row">
    <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{ $vehicle_id }}">
    <input type="hidden" name="s_type" id="s_type" value="{{ $s_type }}">

    @if($s_type == "VillageName")
    <label for="village_name" style="width: 100px;">{{ trans('module4._village') }}:</label>
    <input type="text" name="new_village_name" id="new_village_name" value="" style="width: 50%;" title="{{ trans('module4._village') }}" >

    @elseif($s_type == "Color")
    <label for="color_name" style="width: 100px;">{{ trans('module4.color') }}:</label>
    <input type="text" name="new_color_name" id="new_color_name" value="" style="width: 200px;" title="{{ trans('module4.color') }}" >
    @elseif($s_type == "Model")
    <label for="model_name" style="width: 100px;">{{ trans('module4._model') }}:</label>
    <input type="text" name="new_model_name" id="new_model_name" value="" style="width: 200px;" title="{{ trans('module4._model') }}" onpaste="return false;" 
    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) 
    || (event.charCode >= 48 && event.charCode <= 57) || (event.keyCode == 45)" autofocus>

    @endif

    <button type="button" id="btnAdd" name="btnAdd" class="btn btn-sm btn-success" style="width: 90px;margin-left: 10px;height: 28px;">{{trans('button.add')}}</button>

</div>
