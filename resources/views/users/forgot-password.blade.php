<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        body #login{
  background: url(../images/lao.jpg) no-repeat center;
    height: 700px;
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

.container{
  padding-top:50px;
  margin: auto;
}
    </style>

</head>
<body>
    <div id="login">
        

        <main class="py-4">
           <div class="container">
            @if(Auth::check())
            <div class="row justify-content-center">
            <div class="col-md-4">
            <div class="card" style="margin-top:100px">
               
                <div class="card-body">
                <a class="dropdown-item" @if(Auth::user()->user_type =="staff") href="{{url('home')}}" @else href="{{url('customer')}}" @endif>Dashboard</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon dripicons-lock"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                </div>
            </div>
        </div>
    </div>
            @else
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="margin-top:100px">
                <h5 class="text-center" style="padding-top: 28px">{{ __('Reset Password') }}</h5>
                @include('flash')
                <div class="card-body">
                    <form id="login-form" name="login-form" class="nobottommargin" action="{{url('password-reset',$email)}}" method="post">
        
        {{ csrf_field() }}

        <div class="form-row">
            <div class="col-md-12 mb-3">
            <label for="validationCustom01">Email</label>
           <input id="email" name="email" value="{{$email !=''?$email:''}}"  type="text" class="form-control input-lg"  readonly="">
            </div>
           
            <div class="col-md-12 mb-3">
            <label for="validationCustom01">Password</label>
             <input id="password-field" type="password" placeholder="Enter New Password" class="form-control" name="password" value="">
             <span toggle="#password-field" class="fa fa-eye field-icon password"></span>
            </div>
           <div class="col-md-12 mb-3">
           <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <input id="password-field1" type="password" class="form-control" name="password_confirmation" placeholder="Enter Confrim password" required autocomplete="new-password">
            <span toggle="#password-field1" class="fa fa-eye field-icon confirm-password"></span>
                            
           </div>

        </div>
       
        <div class="form-actions">
            <div id="working"></div>
            <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
        </div>
       

    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
        </main>
    </div>
        <script src="{{asset('assets/plugins/jquery/jquery-3.3.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/visible-password.js')}}"></script>
</body>

</html>
