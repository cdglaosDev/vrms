<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{asset('vrms2/css/role-page.css')}}">
<div class="modal-header">
<h3>{{trans('title.role_edit')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-dismissable alert-danger">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach          
              </strong>
            </div>
        @endif
        
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id],'onsubmit'=>'return myFunction(this.form)']) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                  <input type="hidden" id="role_name" title="{{ trans('title.role_required') }}" title1="{{ trans('title.role_taken') }}">
                    <label>{{ trans('user.name')}}:</label>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control role-name')) !!}
                </div>
                <input type="hidden" class="old-role" value="{{ $role->name }}">
            </div>
          
            <div class="col-xs-12 col-sm-12 col-md-12 pt-4">
                <div class="form-group">
                    <label name="permission">{{ trans('user.permission')}}:</label>
                    <br/>
                    
                    <div class="col-md-12 col-sm-6">
                    @component('component.role-permission',["role"=>$role,"rolePermissions" =>$rolePermissions])
                    @endcomponent
                   
                </div>
           
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                <a class="btn  btn-sm btn-secondary" href="{{route('roles.index')}}">{{trans('button.cancel')}}</a>
                <button type="submit" class="btn btn-sm btn-success">{{trans('button.update')}}</button>
            </div>
        </div>
        {!! Form::close() !!}
        </div>
</div>
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
  var result = roleData.filter(function(elem){
      return elem != $(".old-role").val(); 
   });
    if(result.includes($(".role-name").val())){
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