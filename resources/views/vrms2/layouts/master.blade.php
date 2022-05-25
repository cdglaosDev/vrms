<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'VRMS') }}</title>
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
   <div id="inner-menu">
      @if(Auth::check())
         <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" >
               <img src="@if(auth()->user()->user_photo){{ asset('images/user/'. auth()->user()->user_photo)}} @else {{asset('images/default.png')}} @endif" width="20" height="20" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
               <a class="dropdown-item" href="{{url('/change-password')}}">
               <i class="mdi mdi-settings text-primary"></i>
              {{ trans('sidebar.change_password') }}
               </a>
            </div>
         </li>
         <div style="font-weight:bold">
         ຜູ້ໃຊ້: {{ auth()->user()->name ?? ''}}&nbsp; {{ auth()->user()->user_info->province->name ?? ''}} |
         </div>
      @endif
      <a  href="{{ route('user.logout') }}" onclick="event.preventDefault();
         document.getElementById('logout-form').submit();">{{ trans('sidebar.logout') }}</a>
      <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
         @csrf
      </form>
      @can('All-Vehicles')
         <a href="{{ url('/all-vehicle') }}" load="allvehicles" class="@yield('all_vehicle')">{{ trans('sidebar.all_vehicle') }}</a>
      @endcan
      @can('Create-Price-List')
         <a class="nav-link @yield('price_list_main')" href="{{route('price-list.create')}}">{{trans('sidebar.create_price_list')}}</a>	
      @endcan
      @can('User-Management')
         <a href="{{ url('/users') }}" class="@yield('staff')@yield('api_user')@yield('customer')@yield('role')@yield('permission')">{{ trans('sidebar.staff_mang') }}</a>
      @endcan

      @can('Financial-Management')
         <a href="{{ url('/price-list') }}" class="@yield('price_list')@yield('price_item')@yield('match_payment')@yield('counter_match')@yield('daily_report')@yield('summary_report')">{{ trans('sidebar.fin_mang') }}</a>
      @endcan
      
      @can('Table-Management')
         <a href="{{ url('/admin/country') }}" class="@yield('country')@yield('province')@yield('district')@yield('village')@yield('position')@yield('occupation')
            @yield('service')@yield('nation')@yield('v_sale')@yield('driving_school')@yield('dept')@yield('v_cat')@yield('v_type_group')@yield('v_type')@yield('v_model')@yield('v_brand')@yield('v_kind')@yield('steering')
            @yield('eng_type')@yield('eng_brand')@yield('app_doc')@yield('app_purpose')@yield('working_group')@yield('working_status')
            @yield('division')@yield('money')@yield('color')@yield('inspect_place')@yield('alphabet_status')">{{ trans('sidebar.table_mang') }}
         </a>
      @endcan

      @can('Vehicle-Management')
         <a href="{{route('license-alphabet.index')}}" class="@yield('alphabet')@yield('alphabet_control')@yield('lic_sale')@yield('lic_not_sale')
            @yield('lic_booking')@yield('lic_present')@yield('div_control')@yield('pro_control')@yield('v_transfer')@yield('reg_no')">{{ trans('sidebar.vims') }}
         </a>
      @endcan

      @can('Vehicle-Import-Management')
         <a href="{{ url('/import-vehicle')}}" class="@yield('importer')">{{ trans('sidebar.veh_import_man_sys') }}</a>
      @endcan

      @can('Vehicle-Transfer')
         <a class="nav-link @yield('v_transfer_main_menu')" href="{{route('vehicle-transfer.index')}}"> {{trans('sidebar.vehicle_transfer')}}</a>
      @endcan

      @can('Vehicle-Passport')
         <a href="{{ url('/vehicle-passport')}}" class="@yield('new_register')@yield('passport_list')@yield('passport_report')">{{ trans('sidebar.veh_passport') }}</a>
      @endcan

      @can('Application-Form')
      <a class="nav-link @yield('app_form')" href="{{route('applications.index')}}"> {{trans('sidebar.app_form')}}</a>
      @endcan

      @can('Display On Screen')
         <a class="nav-link" href="{{route('display-screen.display-screen',['id'=>auth()->user()->department_id])}}">{{trans('sidebar.display_onscreen')}}</a>
      @endcan

     @can('Price-List-Display-Screen')
       <a class="nav-link" href="{{route('price-list-display-screen.display-screen',['pcode'=>\App\Helpers\Helper::current_province(),'cid'=>\App\Helpers\Helper::counterId()])}}">{{trans('sidebar.price_list_display_screen')}}</a>
      @endcan
      
      @can('Vehicle-Inspection')
         <a href="{{route('vehicle-inspection.index')}}" class="@yield('vehicle_inspect')">{{trans('sidebar.vehicle_inspect')}}</a>
      @endcan

      @can('Traffic-Police')
         <a href="{{ url('/traffic-police')}}" class="@yield('traffic_police')">{{trans('sidebar.traffice_police')}}</a>
      @endcan
      @can('Annouce')
      <a href="{{ url('/announcement-page-list') }}" class="@yield('anno_page')">{{ trans('sidebar.annouce') }}</a>
      @endcan
      @can('User-Manual-Guide')
         <a href="{{ url('/api-guide') }}" class="@yield('api_guide')@yield('smart_cart_guide')">{{ trans('sidebar.api') }}</a>
      @endcan

      @can('Setting')
         <a href="{{ route('display-setting.index') }}" class="@yield('display_setting')@yield('smart_card_setting')@yield('smart_card_logo')@yield('price_list_display_setting')">{{trans('sidebar.setting')}}</a>
      @endcan

      @can('Report')
         <a href="{{ route('user-report.index') }}" class="@yield('user_report')@yield('pre_report')@yield('reg_report')@yield('transfer_report')@yield('card_report')">{{ trans('sidebar.report') }}</a>
      @endcan

      @can('Action-Log')
         <a href="{{ route('action-log.index') }}" class="@yield('action_log')">{{trans('sidebar.action_log')}}</a>
      @endcan

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
      <span style="float:right;margin-right:10px">  <input type="text" name="display_text" id="display_text"></span>
   </div>
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
   <div id="content" class="loggedin" style="width: 100%;">
      @yield('content')
   </div>
   <script src="{{ asset('vrms2/js/jquery.min.js') }}" ></script>
   <script src="{{ asset('vrms2/js/bootstrap.bundle.min.js') }}" ></script>
   <script src="{{ asset('vrms2/js/bootstrap.min.js') }}" ></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <script src="{{asset('vrms2/js/bootstrap-datepicker.min.js')}}"></script>
   <script src="{{ asset('vrms2/js/vehicle-datepicker.js') }}"></script>
   <script src="{{ asset('vrms2/js/datatables.min.js') }}" ></script>
   <script type="text/javascript" src="{{asset('vrms2/js/bootstrap-fileinput.js')}}"></script>
 
   @stack('page_scripts')
   <script>

      $('#display_text').keyup(function(event) {

       event.preventDefault();
        var app_number = $('#display_text').val();
        if (event.keyCode == 13) {
           //alert("text");
            if(app_number){
                  var _token   = $('meta[name="csrf-token"]').attr('content');
                     $.ajax({
                        type:'POST',
                        url:'/display/update',
                        data:{app_number:app_number,_token: _token},
                        success:function(data){
                        alert(data.status);
                        }
                     });
            }else{
                  alert("Need to fill App No.");
                  
            }

      } else {
               //alert("search text");
               return true;
            }
            /*
            if (event.keyCode == 13) {
               var message =  $('#display_text').val();
               alert(message);
            } else {             
               return true;
            }
            */
      }); //display search box keyup

      $(document).ready(function() {
			setTimeout(function(){
			$(".duplicate").remove();
			}, 5000 ); 
         $('.js-example-basic-single').select2();
      });
    
      $('#myTable').dataTable( {
      	"lengthMenu": [[25, 50, 75, 100], [25, 50, 75, 100]]
      });

      //datatable for import lists
      // $('#importVeh').dataTable( {
      // 	"pageLength": 100
      // });
     
      $('#editModel, #addModel').on('hidden.bs.modal', function () {
         $("#editModel, #addModel").find('form').trigger('reset');
         $('.js-example-basic-single').val(null).trigger('change');
         // $(".status, .upd-status").text("");
      });

      $(" #inspect_issue_date, #datetime, #from_date,#to_date, #inspect_expire_date, #expire_date, #issue_date, #date, #startlock, #endlock, .date, #transfer_issue_date").datepicker({
         
         format: 'dd/mm/yyyy',
         autoclose:true
      });
 
   $(".price_date").datepicker({
      format: 'dd/mm/yyyy',
      autoclose:true,
      startDate:new Date(),
   });
   //date format for keypress
   $(".price_date").on('keydown', function (e) {
      IsNumeric(this, e.keyCode);
   });
   var isShift = false;
   var seperator = "/";
   function IsNumeric(input, keyCode) {
      if (keyCode == 16) {
      isShift = true;
      }
   //Allow only Numeric Keys.
   if (((keyCode >= 48 && keyCode <= 57) || (keyCode >= 96 && keyCode <= 105)) && isShift == false) {
      if ((input.value.length == 2 || input.value.length == 5) && keyCode != 8) {
            input.value += seperator;
      }
      return true;
   } else {
   return false;
   }
   };
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