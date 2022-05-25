<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <link rel="icon" type="image/png" sizes="32x32" href="/images/icon.png">
      <link rel="stylesheet" href="{{ asset('/vrms2/css/bootstrap.min.css') }}" />
      <link rel="stylesheet" href="{{asset('template/vendors/iconfonts/font-awesome/css/font-awesome.min.css')}}">
      <link rel="stylesheet" href="{{ asset('/vrms2/css/style.css') }}" />
      <link rel="stylesheet" href="{{ asset('/vrms2/css/nvt-core.css') }}" />
      <link rel="stylesheet" href="{{ asset('/vrms2/css/datatables.min.css') }}" />
      <link rel="stylesheet" type="text/css" href="{{asset('vrms2/css/bootstrap-fileinput.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('vrms2/css/bootstrap-datepicker.min.css')}}">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="{{ asset('/vrms2/css/custom.css') }}" />
   </head>
   <body style="margin:0px;" @if (env('APP_ENV') == 'production') oncontextmenu="return false" @endif>
   <!-- start menu bar -->
   <div id="inner-menu" style="min-height: 40px !important;">
      @if(Auth::check())
      <img src="@if(auth()->user()->user_photo){{ asset('images/user/'. auth()->user()->user_photo)}} @else {{asset('images/default.png')}} @endif" width="20" height="20" alt="">
        
         <div style="font-weight:bold">
         ຜູ້ໃຊ້: {{ auth()->user()->name ?? ''}}&nbsp; {{ auth()->user()->user_info->province->name ?? ''}} |
         </div>
      @endif
     
      <a  href="{{ route('user.logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">{{ trans('sidebar.logout') }}</a>
      <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
         @csrf
      </form>
      <a href="{{ url('/customer') }}">{{trans('sidebar.dashboard')}}</a>
      <a href="{{ url('/customer/vehicle-detail')}}"> {{trans('sidebar.import_app_list')}}</a>
      <a href="{{ url('/customer/profile') }}"> Profile</a>

      @php $locale = session()->get('locale'); @endphp
      <li class="nav-item dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">
         @switch($locale)
         @case('en')
         <img src="{{asset('images/en_flag.png')}}" width="30px" height="20x">
         @break
         @default
         <img src="{{asset('images/la_flag.png')}}" width="30px" height="20x">
         @endswitch
         </a>
         <div class="dropdown-menu dropdown-menu-right">
            <a href="{{url('lang/la')}}" class="dropdown-item"><img src="{{asset('images/la_flag.png')}}" width="30px" height="20x"> Lao</a>
            <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('images/en_flag.png')}}" width="30px" height="20x"> Eng</a>
         </div>
      </li>
      <a class="p-0" href="https://vdvclao11.org/thongpong/test124ປປ">
         <marquee scrollamount="1">ລະບົບຂັດຂ້ອງແຈ້ງ 22432897  , 55463399  ,  28267691 , 99558862</marquee>
      </a>
   </div>
   <!-- end menu bar -->

   @if (env('APP_ENV') == 'production')
   <script>//disable for inspect element disabled for security
      document.onkeydown = function(e) {
      if(event.keyCode == 123) {
         return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
         return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
         return false;
      }
      if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
         return false;
      }
      if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
         return false;
      }
      }
   </script>
   @endif
   <!-- start content section -->
   <div id="content" class="loggedin" style="width: 100%;top: 47px !important;">
      @yield('content')
   </div>
   <!-- end content section -->

   <script src="{{ asset('vrms2/js/jquery.min.js') }}" ></script>
   <script src="{{ asset('vrms2/js/bootstrap.bundle.min.js') }}" ></script>
   <script src="{{ asset('vrms2/js/bootstrap.min.js') }}" ></script>
   <script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
   <script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
   <script src="{{ asset('vrms2/js/datatables.min.js') }}" ></script>
   <script type="text/javascript" src="{{asset('vrms2/js/bootstrap-fileinput.js')}}"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script type="text/javascript" src="{{ asset('vrms2/js/select2.js') }}"></script>
   
   @stack('page_scripts')
   <script>
      
       $(document).ready(function() {
         $('.js-example-basic-single').select2();
      });

      // $('#myTable').dataTable( {
      // 	"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
      // });
    
      $('#submit-box, #showModal, #editModal, #newModal').on('hidden.bs.modal', function () {
         $("#submit-box, #showModal, #editModal, #newModal").find('form').trigger('reset');
        // $('#submitForm').find('input[type="hidden"]').val('');
        // $("#submitForm")[0].removeClass('submitButton');
         //$('.js-example-basic-single').val(null).trigger('change');
      });
     
         $(" #inspect_issue_date, #inspect_expire_date, #expire_date, #issue_date, #date, #startlock, #endlock, .date, #transfer_issue_date").datepicker({
           
           format: 'yyyy-mm-dd',
      	  autoclose:true
          
         });
         $("#datetime").datepicker({
           format: 'dd-mm-yyyy',
      	  autoclose:true
         });
         $("#from_date").datepicker({
           format: 'dd-mm-yyyy',
      	  autoclose:true
         });
         $("#to_date").datepicker({
           format: 'dd-mm-yyyy',
      	  autoclose:true
         });
         var today = new Date();
         $("#print_date").datepicker({
           format: 'yyyy-mm-dd',
           autoclose:true,
          
         });
         $('#print_date').datepicker('setDate', today);
        
         $( ".date-year" ).datepicker({
           format: 'yyyy',
           autoclose: true,
           viewMode: "years", 
           minViewMode: "years",
           startDate: '1970',
           endDate: 'y',
      
         });
      
   </script>
   </body>
</html>