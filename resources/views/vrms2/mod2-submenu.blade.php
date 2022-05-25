<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
        @can('Manage-Price-List')<a class="nav-link @yield('price_list')" href="{{route('price-list.index')}}">{{trans('sidebar.mang_price_list')}}</a>	@endcan
        @can('Manage-Price-Item')<a class="nav-link @yield('price_item')" href="{{route('price-item.index')}}">{{trans('sidebar.mang_price_item')}}</a>@endcan
        @can('Match-Payment')<a class="nav-link @yield('match_payment')" href="{{route('match-payments.index')}}">{{trans('sidebar.match_payment')}}</a>@endcan
        @can('ServiceCounter-Matching')<a class="nav-link @yield('counter_match')" href="{{route('counter-matching.index')}}">{{trans('sidebar.service_counter_match')}}</a>@endcan
        @can('Daily-Report')<a  class="nav-link @yield('daily_report')" href="{{route('daily-report.index')}}">{{trans('sidebar.daily_report')}}</a>@endcan
	    @can('Summary-Report')<a class="nav-link @yield('summary_report')" href="{{route('summary-report.index')}}">{{trans('sidebar.summary_report')}}</a>@endcan
	
    </div>
</div>
              