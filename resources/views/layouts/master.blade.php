<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name') }}</title>
  <!-- plugins:css -->
  <link rel="icon" type="image/png" sizes="16x16" href="/vrms2/icon.png">
  <link rel="stylesheet" href="{{asset('template/vendors/iconfonts/mdi/font/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/css/vendor.bundle.addons.css')}}">
  <link rel="stylesheet" href="{{asset('template/vendors/iconfonts/font-awesome/css/font-awesome.min.css')}}">
 
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
    <!-- custom:css -->
    @php($dt = new DateTime())
    @php($strrun = $dt->format('His'))
    <link rel="stylesheet" href="{{asset('css/custom.css').'?'.$strrun}}">
    <link rel="stylesheet" href="{{asset('css/xxl.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-fileinput.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
  <!-- custom -->
     <link rel="shortcut icon" href="{{asset('images/logo.png')}}" />
</head>

<body class="sidebar-icon-only" @if (env('APP_ENV') == 'production') oncontextmenu="return false" @endif>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
   @include('layouts.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
        @include('layouts.sidebar')

      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper" style="padding-top:0px;">
                @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020. All rights reserved.</span>
            
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
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
  }</script>
  @endif
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('template/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('template/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
 
  <script src="{{ asset('template/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('template/js/template.js') }}"></script>
  <script src="{{ asset('template/js/settings.js') }}"></script>
  <script src="{{ asset('template/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  
  <script src="{{ asset('template/js/typeahead.js')}}"></script>
  <script src="{{ asset('template/js/select2.js')}}"></script>
  <script src="{{ asset('template/js/data-table.js')}}"></script>
  
  <script type="text/javascript" src="{{asset('js/bootstrap-fileinput.js')}}"></script>
  <script src="{{asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
  
  <script>
  
    $('.modal-header .close').click(function() {
    history.go(0);
    });
     $("#import_permit_date,#industrial_doc_date, #technical_doc_date, #comerce_permit_date, #tax_payment_date, #police_doc_date, #tax_date").datepicker({
      
      format: 'yyyy-mm-dd',
      autoclose:true,
      endDate: new Date(new Date().setDate(new Date().getDate() ))
     
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

   
        // var flag = false;
        // message = function(){
        //     if(!flag){
        //         $.ajax({
        //             url:"{{route('notifications.render')}}",
        //             success:function(data){
                      
        //                 if(!flag){
        //                     $(".unreadcount").html(data.unreadcount);
        //                     $(".preview-item-content").html(data.html);
        //                 }
        //             }
        //         });
        //     }
        // };
        // $(function () {
        //     message();
        //     setInterval(message,5000);
        //     $('.preview-item-content').mouseover(function() {
        //         flag = true;
        //     });
        //     $('.preview-item-content').mouseout(function() {
        //         flag = false;
        //     });
        //     $("body").on("click", ".markasread-handle", function (e) {
        //         id = $(this).data('id');
        //         $.ajax({
        //             url:"{{url('/notification/unreadtoread/')}}/"+id,
        //             success:function(){
        //             }
        //         });
        //     });
        // });
   
  </script>
  <!-- End custom js for this page-->
  @stack('page_scripts')
</body>

</html>
