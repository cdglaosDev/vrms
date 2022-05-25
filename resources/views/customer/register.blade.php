<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name') }}</title>
      <!-- Scripts -->
      <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
      <link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('vrms2/css/bootstrap-fileinput.css')}}">
      <link href="{{asset('vrms2/css/bootstrap.min.css')}}" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <style type="text/css">
         body #login{
         background: url(/../images/bg.jpeg) no-repeat center;
         height: 657px;
         background-size: cover;
         position: relative;
         }
         .field-icon {
         float: right;
         margin-left: -25px;
         margin-top: -25px;
         position: relative;
         z-index: 2;
         margin-right: 10px;
         }
      </style>
   </head>
   <body>
      @php
      $dis =\App\Model\District::whereStatus(1)->pluck('district_code','name');
      $pro =\App\Model\Province::whereStatus(1)->pluck('province_code','name');
      $depart = \App\Model\Department::whereStatus(1)->get();
      @endphp
      <div id="login">
         <div class="container-fluid">
            <div class="row" style="justify-content: flex-end;display: flex">
               <div class="col-md-4"  style="background-color: white">
                  <div class="" style="padding-bottom: 13px;padding-top: 13px;background-color: white">
                     @include('flash')
                     <div class="card-body" style="justify-content: flex-end">
                        <form action="{{route('customer.register')}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                              <div class="col-sm-12" style="text-align: center">
                                 <div class="form-group">
                                    @include('image_upload')
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input id="name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required  placeholder="Enter First Name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" value="{{ old('last_name') }}" required="" placeholder="Enter Last Name" />
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{ old('phone') }}" title="Please Enter at least 8 digits" pattern="[0-9]{8,}" required="">
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input type="password" id="password-field" name="password" class="form-control" placeholder="Enter Password" value="" required="">
                                    <span toggle="#password-field" class="fa fa-eye field-icon password"></span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input id="password-field1" type="password" class="form-control" name="confirm-password" required autocomplete="new-password" value="" placeholder="Confirm Password">
                                    <span toggle="#password-field1" class="fa fa-eye field-icon confirm-password"></span>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input type="text" name="birthdate" class="date form-control" value="{{ old('birthdate') }}" placeholder="Enter Birthdate" required="">    
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <select name="province_code" id="province" class="form-control select2-hidden-accessible" id="state" required="">
                                       @foreach($pro as $key => $value)
                                       <option value="" selected disabled hidden>-- Select Province-- </option>
                                       <option value="{{ $value }}" class="style1">{{ $key }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <select name="district_code" id="district" class="form-control select2-hidden-accessible" id="state" required="">
                                       <option value=""  selected disabled hidden>-- Select District-- </option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-sm-6">
                                 <div class="form-group">
                                    <input type="radio" name="gender"  value="male" required>Male
                                    <input type="radio" name="gender" value="female">Female
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <textarea name="address" class="form-control" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group text-center">
                              <button type="submit" class="btn btn-primary btn-sm btn-block " style="background-color: #0e178a">{{trans('button.register')}}</button>
                           </div>
                           <div class="form-group text-center">
                              <a class="" href="{{url('/')}}">{{trans('button.cancel')}}</a>
                           </div>
                     </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
      <script src="{{asset('assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('vrms2/js/visible-password.js')}}"></script>
      <script type="text/javascript">
         var dist_url="{{url('district')}}";
         $(document).ready(function(){
         
         $('#province').change(function(){
         var province_code = $(this).val(); 
             if(province_code){
                 $.ajax({
                 type:"GET",
                     url:dist_url+ "/"+province_code,
                     dataType: 'json',
                     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                 success:function(data){  
                
                     if(data){
                         $("#district").empty();
                         $("#district").append('<option>Select</option>');
                         $.each(data,function(key,value){
                             $("#district").append('<option value="'+key+'">'+value+'</option>');
                         });
             
                     }else{
                     $("#district").empty();
                     }
                 }
                 });
             }else{
                 $("#district").empty();
             
             }      
         });
           $(".date").datepicker({
           format: 'dd/mm/yyyy',
           autoclose:true
         });
         
         });
         
      </script>
      <script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
      <script type="text/javascript" src="{{asset('vrms2/js/bootstrap-fileinput.js')}}"></script>
   </body>
</html>