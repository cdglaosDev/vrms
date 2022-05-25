<div class="modal fade" id="addModel1" tabindex="-1" role="modal-dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg " role="document">
      <div class="modal-content">
         <form enctype="multipart/form-data" action="{{route('province.store')}}" id="addform" method="POST">
            @method('post')
            @csrf
            <input type="hidden" id="new-id" value="">
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('table_man.add_pro')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.pro_code')}}:</label>
                     <input type="number" class="form-control province_code"  value="" placeholder="Enter Province Code" name="province_code" required="" title="{{trans('table_man.province_msg_pro_code')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01"> {{trans('table_man.pro_name')}}:</label>
                     <input type="text" class="form-control province_name"  value="" placeholder="Enter Province Name(Laos)" name="name" required="" title="{{trans('table_man.province_msg_name')}}">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.pro_namee')}}:</label>
                     <input type="text" class="form-control province_name_en"  value="" placeholder="Enter Province Name(English)" name="name_en" required="" title="{{trans('table_man.province_msg_name_en')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">{{trans('table_man.old_name')}}:</label>
                     <input type="text" class="form-control old_name"  value="" placeholder="Enter Old Province Name" name="old_name">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.abb_name')}}:</label>
                     <input type="text" class="form-control abb_name"  value="" placeholder="Enter Abbreviation Name(Laos)" name="abb" required="" title="{{trans('table_man.province_msg_abb_name')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">{{trans('table_man.abb_namee')}}:</label>
                     <input type="text" class="form-control abb_name_en"  value="" placeholder="Enter Abbreviation Name(English)" name="abb_en" title="{{trans('table_man.province_msg_abb_name_en')}}">
                  </div>
               </div>
               <div class="form-row">
               
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.index_country_name')}}:</label>
                     <select name="country_id" class="js-example-basic-single form-control country"  style="width:100%" required="" title="{{trans('table_man.province_msg_country')}}">
                        @foreach( $country as $data)
                        <option value="{{ $data->id }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control status">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('common.desc')}}:</label>
                     <textarea name="desc" rows="3" class="form-control" placeholder="Enter Province Description" required=""></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
               <button type="submit"  class="btn btn-success btn-sm btn-save" id="add-form">{{trans('button.save')}}</button>
            </div>
      </div>
      </form>
   </div>
</div>

<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <form action="" id="editform" name="editform" method="POST">
            @method('PATCH')
            @csrf
            <input type="hidden" id="edit-id" value="">
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('table_man.update_pro')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.pro_code')}}:</label>
                     <input type="number" class="form-control province_code"  value="" placeholder="Enter Province Code" name="province_code" readonly title="{{trans('table_man.province_msg_pro_code')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.pro_name')}}:</label>
                     <input type="text" class="form-control province_name"  value="" placeholder="Enter Province Name" name="name" required="" title="{{trans('table_man.province_msg_name')}}">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.pro_namee')}}:</label>
                     <input type="text" class="form-control province_name_en"  value="" placeholder="Enter Province Name" name="name_en" required="" title="{{trans('table_man.province_msg_name_en')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">{{trans('table_man.old_name')}}:</label>
                     <input type="text" class="form-control old_name"  value="" placeholder="Enter Old Province Name" name="old_name">
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.abb_name')}}:</label>
                     <input type="text" class="form-control abb_name"  value="" placeholder="Enter Abbreviation Name(Laos)" name="abb" required="" title="{{trans('table_man.province_msg_abb_name')}}">
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="">{{trans('table_man.abb_namee')}}:</label>
                     <input type="text" class="form-control abb_name_en"  value="" placeholder="Enter Abbreviation Name(English)" name="abb_en" title="{{trans('table_man.province_msg_abb_name_en')}}" >
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('table_man.country_name')}}:</label>
                     <select name="country_id" class="form-control country" title="{{trans('table_man.province_msg_country')}}">
                        @foreach( $country as $data)
                        <option value="{{ $data->id }}" class="style1">{{ $data->name }}({{$data->name_en}}) </option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-6 mb-3">
                     <label for="validationCustom01">{{trans('common.status')}}:</label>
                     <select name="status" class="form-control status">
                        <option value="1">Active</option>
                        <option value="0">Deactive</option>
                     </select>
                  </div>
               </div>
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01">{{trans('common.desc')}}:</label>
                     <textarea name="desc" rows="3" class="form-control" placeholder="Enter Province Description"></textarea>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('table.cancel')}}</button>
               <input type="submit" class="btn btn-success btn-sm btn-save" value="{{trans('table.update')}}" id="edit-form">
            </div>
      </div>
      </form>
   </div>
</div>
