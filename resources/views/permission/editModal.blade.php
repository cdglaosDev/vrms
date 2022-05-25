@php
$pre_permission = \App\Model\PreDefinePermission::get();
@endphp
<div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form action="" method="POST"  id="editform" name="editform">
            @method('PATCH')
            @csrf
            <div class="modal-header">
               <div class="col-md-11 text-center">
                  <h3 class="text-center">{{trans('title.per_edit')}}</h3>
               </div>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="form-row">
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> {{trans('common.name')}}:</label>
                     <select name="name" id="pname" class="form-control">
                        <option value="" selected disabled> Select Name</option>
                        @foreach($pre_permission as $data)
                        <option value="{{$data->name}}">{{$data->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-12 mb-3">
                     <label for="validationCustom01"> Type:</label>
                     <select name="type" id="type" class="form-control">
                        <option value="" selected > Select Type</option>
                     </select>
                  </div>
               </div>
               <div class="col-md-12">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">{{trans('button.cancel')}}</button>
                  <input type="submit" class="btn btn-success " value="{{trans('button.update')}}">
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   $('#pname').change(function(){
   var pname = $(this).val(); 
   getCategoriesByDegree(pname);
   });
   
   function getCategoriesByDegree(pname, type) {
   $("#type").empty();
   if(pname>0){
       $.ajax({
           type:"GET",
           url:getPtype+"/"+pname,
           success:function(data){     
               $("#type").empty(); 
               if(data){
                   $("#type").append('<option>- Select -</option>');
                   $.each(data, function(key,value){
                       $("#type").append('<option value="'+value+'">'+value+'</option>');
                   });
                   if(type>0) {
                       $('[name="type"]').val(type);
                   }
               }
           }
       });
   }
   }
</script>