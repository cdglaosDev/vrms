
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
  background: url(./images/lao.jpg) no-repeat center;
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
          
            <div class="row justify-content-center">
            <div class="col-md-5">
            <div class="card" style="margin-top:100px">
               
                <div class="card-body">
                <div class="title m-b-md">
                <h3>You cannot access this page! </h3>

<a @if(Auth::check()) @if(Auth::user()->user_type =="staff") href="{{url('home')}}" @else href="{{url('customer')}}" @endif @endif class="btn btn-primary">Back</a>

</div>
                </div>
            </div>
        </div>
    </div>
          
</div>
        </main>
    </div>
   
</body>

</html>
