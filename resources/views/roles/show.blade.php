<div class="modal-header">
   <h3 class="text-center">{{trans('title.role_detail')}}</h3>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
  
      <strong> {{ $role->name }} Role Permissions:</strong><br/><br/>
      <div class="row">
         @foreach($rolePermissions as $v)
         <div class="col-xs-3 col-sm-4 col-md-4">
            <ul>
               <li>{{$v->name}}</li>
            </ul>
         </div>
         @endforeach
      </div>
  
</div>