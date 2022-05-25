<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('Staff')<a class="nav-link @yield('staff')" href="{{route('users.index')}}">{{trans('sidebar.staff')}} </a>@endcan                
        @can('Customer')<a class="nav-link @yield('customer')" href="{{url('/customer-list')}}">{{trans('sidebar.customer')}}</a>@endcan
        @can('Api-User')<a class="nav-link @yield('api_user')" href="{{ url('/api-user') }}">{{trans('sidebar.api_user')}}</a>@endcan
        @can('Role')<a class="nav-link @yield('role')" href="{{route('roles.index')}}">{{trans('sidebar.role')}}</a>@endcan
        @can('Permission')<a class="nav-link @yield('permission')" href="{{route('permission.index')}}">{{trans('sidebar.permission')}}</a>@endcan
    </div>
</div>
              