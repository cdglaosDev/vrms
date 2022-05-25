<!-- start add modal -->
<div class="modal fade bigger" id="addModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{trans('user.create_api_user')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('api-user.store')}}"  method="POST">
            @csrf
            <div class="modal-body" style="overflow:hidden">
               <div class="row mb-3">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.first_name')}}:</label>
                        <input id="name" type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required  placeholder="Enter First Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.last_name')}}:</label>
                        <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" required>
                     </div>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.email')}}:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required="">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('user.phone')}}:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('user.address')}} :</label>
                        <textarea name="address" class="form-control" rows="4" placeholder="Enter Address" required></textarea>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-3">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('common.status')}}:</label><br/>
                        <select name="status" id="" class="form-control" required>
                           <option value="" selected disabled> Select status</option>
                           <option value="1">Active</option>
                           <option value="0">Deactive</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group text-right mt-4">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- end add modal -->
<div class="modal fade bigger" id="editModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{trans('user.edit_api_user')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="" id="editform" name="editform" method="POST">
            @method('patch')
            @csrf
            <div class="modal-body" style="overflow:hidden">
               <div class="row mb-3">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.first_name')}}:</label>
                        <input id="name" type="text" class="form-control  @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required  placeholder="Enter First Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.last_name')}}:</label>
                        <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name" required>
                     </div>
                  </div>
               </div>
               <div class="row mb-3">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputEmail1">{{trans('user.email')}}:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required="">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('user.phone')}}:</label>
                        <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('user.address')}} :</label>
                        <textarea name="address" class="form-control" rows="4" placeholder="Enter Address" required></textarea>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-3">
                     <div class="form-group">
                        <label for="exampleInputPassword1">{{trans('common.status')}}:</label><br/>
                        <select name="status" id="" class="form-control" required>
                           <option value="" selected disabled> Select status</option>
                           <option value="1">Active</option>
                           <option value="0">Deactive</option>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="form-group text-right mt-4">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm">{{trans('button.cancel')}}</button>
                  <button type="submit" class="btn btn-success btn-sm">{{trans('button.update')}}</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade bigger" id="showModel" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('user.api_user_detail')}}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body" style="overflow:hidden">
            <div class="row mb-3">
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="exampleInputEmail1">{{trans('user.name')}}:<span id="first_name"></span> &nbsp; <span id="last_name"></span></label>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="exampleInputEmail1">{{trans('user.email')}}:  <span id="user_mail"></span></label>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="exampleInputPassword1">{{trans('user.phone')}}:  <span id="phone"></span></label>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="exampleInputPassword1">{{trans('user.address')}} : <span id="address"></span></label>
                  </div>
               </div>
               <div class="col-md-6 col-sm-3">
                  <div class="form-group">
                     <label for="exampleInputPassword1">{{ trans('common.status')}}:  <span id="status" class="front-weight-bold"></span></label>
                  </div>
               </div>
            </div>
         </div>
         </form>
      </div>
   </div>
</div>