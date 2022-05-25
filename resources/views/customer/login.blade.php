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
      <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-fileinput.css')}}">
      <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />
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
        
      </style>
   </head>
   <body>
     
      <div id="login">
         <div class="container-fluid">
            <div class="row" style="justify-content: flex-end;display: flex">
            <div class="col-md-4">&nbsp;</div>
            <div class="col-md-4"  style="background-color: white; position:relative;top:14px;">
                  <div class="" style="padding-bottom: 13px;padding-top: 13px;background-color: white">
                     @include('flash')
                     <div class="card-body" style="justify-content: flex-end">
                        <form action="{{  route('user-login') }}" method="POST" enctype="multipart/form-data">
                           @csrf
                           <h3>Customer Login</h3>
                           <div class="row">
                             
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <input type="text" name="login_id" class="form-control" id="exampleInputEmail1" required="" placeholder="Enter LoginId" />
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="form-group">
                                    <input id="email" type="password" class="form-control" name="password" value="" placeholder="Enter Password" required="">
                                   
                                 </div>
                              </div>
                            
                           </div>
                           <div class="form-group text-center">
                              <button type="submit" class="btn btn-primary btn-sm btn-block " style="background-color: #0e178a">Sign In</button>
                           </div>
                          
                     </div>
                     </form>
                  </div>
               </div>
               <div class="col-md-4">&nbsp;</div>
            </div>
         </div>
      </div>
      
    
    
   </body>
</html>