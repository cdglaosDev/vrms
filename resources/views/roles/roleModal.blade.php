<!-- start add modal -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('vrms2/css/role-page.css')}}">
<div class="modal fade bigger" id="addModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{trans('title.role_create')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="overflow:hidden">
            {!! Form::open(array('route' => 'roles.store','method'=>'POST','onsubmit'=>'return myFunction(this.form)')) !!}
            @csrf
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group">
                     <input type="hidden" id="role_name" title="{{ trans('title.role_required') }}" title1="{{ trans('title.role_taken') }}">
                     <label for="exampleInputEmail1">{{trans('user.name')}}</label>
                     {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control role-name')) !!}
                  </div>
               </div>
            </div>
            <br/>
            <div class="form-group">
               <label for="exampleInputEmail1">{{ trans('user.permission')}}</label><br/>
            </div>
            @component('component.role-permission',['role'=>null,"rolePermissions"=>[]])
            @endcomponent
            <div class="form-group pull-right">
               <a class="btn btn-sm btn-secondary" href="{{route('roles.index')}}">{{trans('button.cancel')}}</a>
               <button type="submit" class="btn  btn-success btn-sm m-r-5">{{trans('button.save')}}</button>
            </div>
            {!! Form::close() !!}
         </div>
      </div>
   </div>
</div>
<!-- end add new modal -->


@push('page_scripts')
<script>
   
   function checkAll(o, type) {
    
      var boxes = document.getElementsByClassName(type);
      for (var x = 0; x < boxes.length; x++) {
      var obj = boxes[x];
         if (obj.type == "checkbox") {
         if (obj.name != "check")
            obj.checked = o.checked;
         }
      }
   }

   function myFunction(){
      if(roleData.includes($(".role-name").val())){
         alert($("#role_name").attr('title1'));
         return false;
      }
      if ($(".role-name").val().trim() == '') {
         alert($("#role_name").attr('title'));
         return false;
      } else if ($('#moduleMang input:checked').length == 0 ) {
         alert("Need to give at least one permission under main menu.");
         return false;
        
      } else{
         return true;
      }
   }
</script>
@endpush