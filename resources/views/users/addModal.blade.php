@php 
$dis =\App\Model\District::whereStatus(1)->pluck('district_code','name'); 
$pro = \App\Model\Province::GetProvince(); 
$depart = \App\Model\Department::whereStatus(1)->get(); 
$counters = \App\Model\ServiceCounter::whereStatus(1)->get(); 

@endphp 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">

<style>
   
    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
      margin-right: 10px;
    }
</style>

<div class="modal fade"  id="addModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h3 class="text-center">{{ trans('user.create_staff') }}</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
<div class="card-body pb-1">
   <form id="staff-user" name="staff-user" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
      @csrf 
      <div class="modal-body">
         <div class="row mb-3">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="first_name">{{trans('user.first_name')}}</label>
                  <input id="name" type="text" class="form-control first_name  @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required placeholder="Enter First Name"> @error('name') <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                  </span> @enderror
               </div>
            </div>
            <div class="col-md-2">
               <div class="form-group">
                  <label for="last_name">{{trans('user.last_name')}}</label>
                  <input type="text" name="last_name" class="form-control last_name"  placeholder="Enter Last Name" required>
               </div>
            </div>
            <div class="col-md-2">
                  <div class="form-group">
                     <label for="email">{{trans('user.email')}}</label>
                     <input id="email" type="email" class="form-control email @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" > @error('email') <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                     </span> @enderror
                  </div>
               </div>
            <div class="col-md-3">
                  <div class="form-group">
                     <label for="facebook">Facebook</label>
                     <input  type="text" class="form-control" name="facebook" value="{{ old('facebook') }}" placeholder="Enter Facebook Link" >
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label for="whatApps">whatApps</label>
                     <input  type="text" class="form-control" name="whatapps" value="{{ old('whatapps') }}" placeholder="Enter whatApps Link" >
                  </div>
               </div>
         </div>
         <div class="row mb-3">
         <div class="col-md-3">
               <div class="form-group">
                  <label for="user_level">{{trans('user.user_level')}}</label>
                  <select name="user_level"  class="form-control user-level" required>
                     <option value="admin" {{auth()->user()->user_level == 'province'?'disabled': '' }}>Admin</option>
                     <option value="province">Province</option>
                  </select>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="user_status">{{trans('user.user_status')}}</label>
                  <select name="user_status"  class="form-control user-status" required>
                     <option value="" selected disabled>Select User Status</option>
                     @foreach(\App\User::getEnumList("user_status") as $key => $value) 
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="user_group">{{trans('user.user_group')}}</label>
                
                     <select name="user_group"  class="form-control user-group" required>
                        <option value="" selected disabled>Select User Group</option>
                        @foreach(\App\User::getEnumList("user_group") as $key => $value) 
                        <option value="{{$key}}" {{ auth()->user()->user_level == "province"?'disabled':''}}>{{$value}}</option>
                        @endforeach
                     </select>
                 
               </div>
            </div>
         </div>
         <div class="row mb-3">
            <div class="col-md-3">
               <div class="form-group">
                  <label for="dob">{{trans('user.dob')}}</label>
                  <input type="text" class="form-control birthdate custom_date" name="birthdate" maxlength="10" required placeholder="Choose Date">
                  </span>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="phone">{{trans('user.phone')}}</label>
                  <input type="number" name="phone" class="form-control phone" placeholder="Enter Phone Number" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="position">{{trans('user.position')}}</label>
                  <input type="text" name="position" class="form-control position" placeholder="Enter Position" required>
               </div>
            </div>
            <div class="col-md-3">
               <div class="form-group">
                  <label for="department">{{trans('user.dept')}}</label>
                  <select name="department_id" class="js-example-basic-single form-control department" style="width:100%;" id="state" required>
                     <option value="" selected disabled hidden>-- Select Department-- </option>
                     @foreach($depart as $data) 
                     <option value="{{ $data->id }}" class="style1">{{ $data->name }} ({{$data->name_en}})</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="row mb-3">
            <div class="col-md-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.province')}}</label>
                     <select name="province_code" class="js-example-basic-single form-control province_code" style="width:100%;" id="province" required>
                        <option value="" selected disabled hidden>-- Select Province-- </option>
                        @foreach($pro as $pro_code) 
                        <option value="{{ $pro_code->province_code }}" @if(auth()->user()->user_level =="province") {{$pro_code->province_code == auth()->user()->user_info->province_code?'selected':'hidden'}} @endif class="style1">{{ $pro_code->name }}</option>
                        @endforeach
                     </select>
                 
               </div>
               <input type="hidden" name="user_type" class="form-control" value="staff" readonly>
            </div>
            <div class="col-md-4 col-sm-4">
               <div class="form-group userRole">
                  <label for="exampleInputPassword1">{{trans('user.role')}}:</label> 
                  {!! Form::select('roles[]', $roles,[], array('class' =>  'form-control multiselect','multiple','required'=>'required', 'id'=>"multipleRole")) !!}
               </div>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('table.status')}}:</label>
                  <select name="customer_status" class="form-control customer-status" required>
                     <option value="" selected disabled>Select Status </option>
                     @foreach(\App\User::getEnumList("customer_status") as $key => $value) 
                     <option value="{{$key}}">{{$value}}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-md-2 col-sm-2">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.gender')}}</label>
                  <br />
                  <input type="radio" name="gender" value="male" checked required>
                  <span class="gender">Male</span>
                  <input type="radio" name="gender" value="female">
                  <span class="gender">Female</span>
               </div>
            </div>
            <div class="col-md-2 col-sm-2">
            <div class="form-group">
                  <label>{{ trans('user.user_photo')}}</label>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new thumbnail" style="height: 100;">
                     <img class="abir_image" src="{{ asset('images/default.png') }}" alt="logo"  width="100"> 
                  </div>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-height: 150px;"> </div>
                  <div>
                     <span class="btn btn-success btn-file">
                     <span class="fileinput-new"> Select File </span>
                     <span class="fileinput-exists">Change </span>
                     <input type="file" id="new-image" name="image" value="user-default.png">
                     </span>
                     
                  </div>
               </div>
               </div>
            </div>
         </div>
         <div class="row">
         <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>User Id</label>
                  <input type="text"  name="login_id"  value="" class="form-control eng-validate login_id" placeholder="Select UserId" required>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>Password</label><br/>
                  <input id="password-field" type="password" placeholder="Enter New Password" class="form-control password" name="password" value="" required>
                  <span toggle="#password-field" class="fa fa-eye field-icon password"></span>
               </div>
            </div>
            <div class="col-md-3 col-sm-3">
               <div class="form-group">
                  <label>Confirm Password</label>
                  <input id="password-field1" type="password" class="form-control password-confirm"  name="password_confirmation" placeholder="Enter Confrim password" required autocomplete="new-password">
                    <span toggle="#password-field1" class="fa fa-eye field-icon confirm-password"></span>
                    
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <label for="exampleInputPassword1">{{trans('user.address')}} :</label>
                  <textarea name="address" class="form-control address" rows="2" placeholder="Enter Address" required></textarea>
               </div>
            </div>
         </div>
         <div class="form-group text-right mt-4">
            <a class="btn  btn-secondary btn-sm" href="{{route('users.index')}}">{{trans('button.cancel')}}</a>&nbsp; 
            <a  class="btn  btn-success btn-sm m-r-5 save-user">{{trans('button.save')}}</a>
         </div>
      </div>
   </form>
</div>
</div>
   </div>
</div>










