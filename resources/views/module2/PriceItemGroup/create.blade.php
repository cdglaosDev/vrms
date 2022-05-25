@extends('layouts.master')
@section('finance','active')
@section('content') 
<style>
  .datepicker.dropdown-menu{
top:305.6251px !important
}
</style>
    <h1 class="page-header">Create Price Item Group</h1>
  <div class="card">
  @include('flash')
    <div class="card-body">
        @isset($item_group)
        <form  action="{{route('items-group.update',['id'=>$item_group->id])}}"  method="POST">
                @method('PATCH')
                @csrf
       
        @else
        <form  action="{{route('items-group.store')}}"  method="POST">
                @method('post')
                @csrf
        @endif
         
         
            <div class="form-row">
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">Group Code:</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ (isset($item_group) ? $item_group->group_code : '') }}" placeholder="Enter Group Code" name="group_code" required="">
             
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('common.name')}} (Lao):</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ (isset($item_group) ? $item_group->group_name : '') }}" placeholder="Enter Group Name" name="group_name" required="">
             
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
                <label for="validationCustom01">{{trans('common.name')}} (Eng):</label>
                <input type="text" class="form-control" id="validationCustom01" value="{{ (isset($item_group) ? $item_group->group_name_en : '') }}" placeholder="Enter Group Name" name="group_name_en" required="">
             
              </div>
              <div class="col-md-4 col-sm-4 mb-3">
              
                <label for="validationCustom01">Price Item:</label>
                @isset($item_group)

                <select name="price_item_id[]" class="form-control multiselect" multiple="multiple" required="">
                @foreach($price_item as $item)
                   
                <option value="{{ $item->id }}" @if(in_array($item->id, $priceitemIds)) selected @endif>{{ $item->name }}({{$item->name_en}})</option>
                   
                @endforeach
               </select>
                @else
                <select name="price_item_id[]" class="form-control multiselect"  multiple="multiple" required="">
                <option value="" selected disabled hidden>Select Price Item</option>  
                @foreach($price_item as $item)     
                    <option value="{{ $item->id }}" >{{ $item->name }}({{$item->name_en}})</option>
                @endforeach
                </select>
                @endif
              </div>
             
              <div class="col-md-3 col-sm-6 mb-3">
                <label for="validationCustom01">{{trans('common.status')}}:</label>
                <select name="status" class="form-control">
                      <option value="" selected disabled hidden>Choose Status </option>
                      @isset($item_group)
                      <option value="1" @if($item_group->status==1) selected="selected" @else @endif>Active</option>
                      <option value="0" @if($item_group->status==0) selected="selected" @else @endif>Deactive</option>
                      @else
                      <option value="1" >Active</option>
                      <option value="0">Deactive</option>
                     
                      @endif
                </select>
              </div>
             
             
              <div class="col-md-12 col-sm-12 mb-3">
                <label for="validationCustom01">Group Note:</label>
                <textarea type="text" class="form-control" rows="4" value="" placeholder="Enter Group Note" name="group_note" >{{ (isset($item_group) ? $item_group->group_note : '') }}</textarea>
              </div>
            </div>
          
           <div class="col-md-12 col-sm-12 text-right">
          
             <a class="btn btn-secondary btn-sm" href="{{route('items-group.index')}}">{{trans('button.cancel')}}</a>
             <button type="submit" class="btn btn-success btn-sm">@isset($item_group){{trans('button.update')}} @else {{trans('button.save')}}@endif</button>
            </div>
        </form>
        
    </div>
  </div>
@include('delete')
 @endsection 
