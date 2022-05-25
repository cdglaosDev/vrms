
<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('New-Register')
            <a class="nav-link @yield('new_register')" href="{{url('/search')}}">{{trans('sidebar.new_register')}}</a>
        @endcan
        @can('Register-Lists')
            <a class="nav-link @yield('passport_list')" href="{{route('vehicle-passport.index')}}">{{trans('sidebar.register_list')}}</a>
        @endcan
        @can('Printing-Passport-Reports')
       <a class="nav-link @yield('passport_report')"  href="{{route('print-passport-report.index')}}">{{trans('sidebar.passport_report')}}</a>
        @endcan
    </div>
</div>