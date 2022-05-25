<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('User-Reports')<a class="nav-link @yield('user_report')"  href="{{route('user-report.index')}}">{{trans('sidebar.user_report')}}</a>@endcan
		@can('Pre-Registration-Reports')<a class="nav-link @yield('pre_report')"  href="{{route('pre-registration-report.index')}}">{{trans('sidebar.pre_reg_report')}}</a>@endcan
        @can('Transfer-Change-Info-Reports')<a class="nav-link @yield('transfer_report')"  href="{{route('transfer-change-report.index')}}">{{trans('sidebar.transfer_report')}}</a>@endcan
        @can('Registration-Reports')<a class="nav-link @yield('reg_report')"  href="{{route('registration-report.index')}}">{{trans('sidebar.reg_report')}}</a>@endcan
        @can('Print-Card-Report')<a class="nav-link @yield('card_report')"  href="{{ url('/print-card-report')}}">Print Card Report</a>@endcan
    </div>
</div>
              