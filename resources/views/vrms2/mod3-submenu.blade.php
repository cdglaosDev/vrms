<div class='p10'>
   <div class='tab-head' style='border-bottom:#ddd solid 1px'>
   @can('Country')<a class="nav-link @yield('country')" href="{{url('admin/country')}}">{{trans('sidebar.country')}}</a>@endcan
   @can('Province')<a class="nav-link @yield('province')"   href="{{url('/admin/province')}}">{{trans('sidebar.province')}}</a>@endcan
   @can('District')<a class="nav-link @yield('district')" href="{{url('/admin/district')}}">{{trans('sidebar.district')}}</a>@endcan
   @can('Village')<a class="nav-link @yield('village')" href="{{url('admin/village')}}">{{trans('sidebar.village')}}</a>@endcan
   @can('Position') <a class="nav-link @yield('position')" href="{{route('position.index')}}">{{trans('sidebar.position')}}</a>@endcan
   @can('Occupation')<a class="nav-link @yield('occupation')" href="{{route('occupation.index')}}">{{trans('sidebar.occupation')}}</a>@endcan
   @can('Service-Counter')<a class="nav-link @yield('service')" href="{{url('admin/service-counter')}}">{{trans('sidebar.service')}}</a>@endcan
   @can('Nationality')<a class="nav-link @yield('nation')" href="{{url('admin/nation')}}">{{trans('sidebar.nation')}}</a>@endcan
   @can('Vehicle-Sale-Center')<a class="nav-link @yield('v_sale')" href="{{route('vehicle-sale.index')}}">{{trans('sidebar.vehicle_sale_center')}}</a>@endcan
   @can('Driving-School')<a class="nav-link @yield('driving_school')" href="{{route('driving-school.index')}}">{{trans('sidebar.driving')}}</a>@endcan
   @can('Department')<a class="nav-link @yield('dept')" href="{{route('department.index')}}">{{trans('sidebar.department')}}</a>@endcan
   @can('Vehicle-Type-Group')<a class="nav-link @yield('v_type_group')" href="{{route('vehicle-type-group.index')}}">{{trans('sidebar.vehicletype_group')}}</a>@endcan
   @can('Vehicle-Type')<a class="nav-link @yield('v_type')" href="{{route('vehicle-type.index')}}">{{trans('sidebar.vehicletype')}}</a>@endcan
   @can('Vehicle-Model')<a class="nav-link @yield('v_model')" href="{{route('vehicle-model.index')}}">{{trans('sidebar.vehiclemodel')}}</a>@endcan
   @can('Vehicle-Brand')<a class="nav-link @yield('v_brand')" href="{{route('vehicle-brand.index')}}">{{trans('sidebar.vehiclebrand')}}</a>@endcan
   @can('Vehicle-Kind')<a class="nav-link @yield('v_kind')" href="{{route('vehicle-kind.index')}}">{{trans('sidebar.vehiclekind')}}</a>@endcan
   @can('Steering')<a class="nav-link @yield('steering')" href="{{route('steering.index')}}">{{trans('sidebar.steeting')}}</a>@endcan
   @can('Engine-Type')<a class="nav-link @yield('eng_type')" href="{{route('engine-type.index')}}">{{trans('sidebar.enginetype')}}</a>@endcan
   @can('Engine-Brand')<a class="nav-link @yield('eng_brand')" href="{{route('engine-brand.index')}}">{{trans('sidebar.enginebrand')}}</a>@endcan
   @can('Application-Doc-Type')<a class="nav-link @yield('app_doc')" href="{{route('application-doc-type.index')}}">{{trans('sidebar.applica_doc_type')}}</a>@endcan
   @can('App-Purpose')<a class="nav-link @yield('app_purpose')" href="{{route('app-purpose.index')}}">{{trans('sidebar.apppurpose')}}</a>@endcan
   @can('Money-Unit')<a class="nav-link @yield('money')" href="{{route('money-unit.index')}}">{{trans('sidebar.money_unit')}}</a>@endcan
   @can('Color')<a class="nav-link @yield('color')" href="{{route('color.index')}}">{{trans('title.color')}}</a>@endcan
   @can('Inspect-Place') <a class="nav-link @yield('inspect_place')" href="{{route('inspect-place.index')}}">{{trans('title.inspect_place_title')}}</a>@endcan
   
   <!-- Remove requested by ICE (17-May-2022) -->
   <!-- @can('Alphabet-Control-Status')<a class="nav-link @yield('alphabet_status')" href="{{route('license-alphabet-control.index')}}"> {{trans('sidebar.alphabet_control_status')}}</a>@endcan -->
   </div>
</div>