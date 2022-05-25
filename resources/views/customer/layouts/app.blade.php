<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icon.png">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" rel="stylesheet">
	
    <link href="{{asset('assets/plugins/font-awesome/css/all.min.css')}}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
    	body{
			font-family: 'Montserrat', sans-serif;
			font-size: 0.82rem;
			letter-spacing: 0.1px;
		}
        body #login{
  background: url(/images/lao.jpg) no-repeat center;
    height:657px;
    background-size: cover;
    position: relative;
}
.field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

.container{
  padding-top:50px;
  margin: auto;
}
    </style>

</head>
<body>
    <div id="login" >
        
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
                <h5 class="text-center" style="padding-top: 28px"> @yield('title')</h5>
                @include('flash')
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
        </main>
    </div>
   
</body>

</html>
