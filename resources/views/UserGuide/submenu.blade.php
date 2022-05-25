<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
    @can('Customer-User-Guide') <a class="nav-link" href="#">{{trans('sidebar.customer_user_guide')}}</a>@endcan
    @can('Officer-User-Guide')<a class="nav-link" href="#">{{trans('sidebar.officer_user_guide')}}</a>@endcan
    @can('Vehicle-Api-Guide')<a class="nav-link @yield('api_guide')" href="{{url('/api-guide')}}">{{trans('sidebar.api_user_guide')}}</a>@endcan
    @can('SmartCard-Api-Guide')<a class="nav-link @yield('smart_cart_guide')" href="{{url('/smart-card-api-guide')}}">{{trans('sidebar.card_user_guide')}}</a>@endcan
    
    </div>
</div>
              