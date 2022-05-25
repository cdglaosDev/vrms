<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('Display-Setting') <a class="nav-link @yield('display_setting')" href="{{ route('display-setting.index') }}">{{trans('sidebar.display_setting')}}</a>@endcan
        @can('Smart-Cart-Setting') <a class="nav-link @yield('smart_card_setting')" href="{{ url('/smartcard-setting') }}">{{trans('sidebar.smart_card_setting')}}</a>@endcan
        @can('Smart-Card-Logo-Sign') <a class="nav-link @yield('smart_card_logo')" href="{{ url('/smart-card-sign') }}">{{trans('sidebar.smart_card_logo')}}</a>@endcan
        @can('Display-Setting') 
        <a class="nav-link @yield('price_list_display_setting')" href="{{ url('/price-list-display-setting') }}">{{trans('sidebar.price_list_display_setting')}}
        </a>
        @endcan
        
    </div>
</div>
              