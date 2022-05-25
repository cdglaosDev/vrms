<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('Alphabet')<a class="nav-link @yield('alphabet')" href="{{route('license-alphabet.index')}}"> {{trans('sidebar.alphabet')}}</a>@endcan
        @can('Alphabet-Control')<a class="nav-link @yield('alphabet_control')" href="{{route('alphabet-control.index')}}"> {{trans('sidebar.alphabet_control')}}</a>@endcan
        @can('License-Number-Sale')<a class="nav-link @yield('lic_sale')" href="{{route('license-number-sale.index')}}"> {{trans('sidebar.lic_sale')}}</a>@endcan
        @can('License-Number-Not-Sale')<a class="nav-link @yield('lic_not_sale')" href="{{route('license-number-not-sale.index')}}"> {{trans('sidebar.lic_not_sale')}}</a>@endcan
        @can('License-Number-Booking')<a class="nav-link @yield('lic_booking')" href="{{route('license-number-booking.index')}}"> {{trans('sidebar.lic_booking')}}</a>@endcan
        @can('License-Number-Present')<a class="nav-link @yield('lic_present')" href="{{route('license-no-present.index')}}"> {{trans('sidebar.lic_present')}}</a>@endcan
        @can('Division-Number-Control')<a class="nav-link @yield('div_control')" href="{{route('division-no-control.index')}}"> {{trans('sidebar.division_control')}}</a>@endcan
        @can('Province-Number-Control')<a class="nav-link @yield('pro_control')" href="{{route('province-no-control.index')}}"> {{trans('sidebar.province_control')}}</a>@endcan
        @can('Registration-Number')<a class="nav-link @yield('reg_no')" href="{{route('registraion-number-control.index')}}">{{trans('module4.license_no_control')}}</a>@endcan
        @can('Vehicle-History')<a class="nav-link @yield('vehicle_history')" href="{{route('vehicle_history.index')}}">{{trans('module4.vehicle_history')}}</a>@endcan
    </div>
</div>
              