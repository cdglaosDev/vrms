<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item @yield('dashboard')">
            <a class="nav-link" href="{{url('/home')}}">
              <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.dashboard')}}</span>
            </a>
          </li>
          @can('User-Management')
          <li class="nav-item @yield('user')">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
            <i class="mdi mdi-comment-account-outline menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.staff_mang')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
              @can('Staff')<li class="nav-item"><a class="nav-link" href="{{route('users.index')}}">{{trans('sidebar.staff')}} </a></li>@endcan                
              @can('Customer')<li class="nav-item"><a class="nav-link" href="{{url('/customer-list')}}">{{trans('sidebar.customer')}}</a></li>@endcan
              @can('Api-User')<li class="nav-item"><a class="nav-link" href="{{ url('/api-user') }}">{{trans('sidebar.api_user')}}</a></li>@endcan
              @can('Role')<li class="nav-item"><a class="nav-link" href="{{route('roles.index')}}">{{trans('sidebar.role')}}</a></li>@endcan
              @can('Permission')<li class="nav-item"><a class="nav-link" href="{{route('permission.index')}}">{{trans('sidebar.permission')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
          @can('Financial-Management')
          <li class="nav-item @yield('finance')">
            <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
            <i class="mdi mdi-finance menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.fin_mang')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="editors">
              <ul class="nav flex-column sub-menu">
                @can('Manage-Price-List')<li class="nav-item"><a class="nav-link" href="{{route('price-list.index')}}">{{trans('sidebar.mang_price_list')}}</a></li>	@endcan
                @can('Manage-Price-Item')<li class="nav-item"><a class="nav-link " href="{{route('price-item.index')}}">{{trans('sidebar.mang_price_item')}}</a></li>@endcan
                @can('Price-Item-Group')<li class="nav-item"><a class="nav-link" href="{{route('items-group.index')}}">{{trans('sidebar.price_item_group')}}</a></li>@endcan
                @can('Match-Payment')<li class="nav-item"><a class="nav-link" href="{{route('match-payments.index')}}">{{trans('sidebar.match_payment')}}</a></li>@endcan
                @can('ServiceCounter-Matching')<li class="nav-item"><a class="nav-link" href="{{route('counter-matching.index')}}">{{trans('sidebar.service_counter_match')}}</a></li>@endcan
              
                <li class="@yield('finance') nav-item"><a href="javascript:;">
								<span>Financial Reports</span>
							</a><ul class="nav flex-column sub-menu">
								@can('Daily-Report')<li class="nav-item"><a  class="nav-link" href="{{route('daily-report.index')}}">{{trans('sidebar.daily_report')}}</a></li>@endcan
								@can('Summary-Report')<li class="nav-item"><a class="nav-link" href="{{route('summary-report.index')}}">{{trans('sidebar.summary_report')}}</a></li>@endcan
							</ul></li>
                </ul>
            </div>
          </li>
          @endcan
          @can('Table-Management')
          <li class="nav-item @yield('list')">
            <a class="nav-link" data-toggle="collapse" href="#list" aria-expanded="false" aria-controls="list">
            <i class="mdi mdi-table-large menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.table_mang')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="list">
              <ul class="nav flex-column sub-menu">
              @can('Country')<li class="nav-item"><a class="nav-link" href="{{url('admin/country')}}">{{trans('sidebar.country')}}</a></li>@endcan
							@can('Province')<li class="nav-item"><a class="nav-link"  href="{{url('/admin/province')}}">{{trans('sidebar.province')}}</a></li>@endcan
							@can('District')<li class="nav-item"><a class="nav-link" href="{{url('/admin/district')}}">{{trans('sidebar.district')}}</a></li>@endcan
							
							@can('Village')<li class="nav-item"><a class="nav-link" href="{{url('admin/village')}}">{{trans('sidebar.village')}}</a></li>@endcan
							@can('Position')<li class="nav-item"><a class="nav-link" href="{{route('position.index')}}">{{trans('sidebar.position')}}</a></li>@endcan
              @can('Occupation')	<li class="nav-item"><a class="nav-link" href="{{route('occupation.index')}}">{{trans('sidebar.occupation')}}</a></li>@endcan
							@can('Service-Counter')<li class="nav-item"><a class="nav-link" href="{{url('admin/service-counter')}}">{{trans('sidebar.service')}}</a></li>@endcan
              @can('Nationality')<li class="nav-item"><a class="nav-link" href="{{url('admin/nation')}}">{{trans('sidebar.nation')}}</a></li>@endcan

              @can('Vehicle-Sale-Center')	<li class="nav-item"><a class="nav-link" href="{{route('vehicle-sale.index')}}">{{trans('sidebar.vehicle_sale_center')}}</a></li>@endcan
							@can('Driving-School')<li class="nav-item"><a class="nav-link" href="{{route('driving-school.index')}}">{{trans('sidebar.driving')}}</a></li>@endcan
							
							@can('Department')<li class="nav-item"><a class="nav-link" href="{{route('department.index')}}">{{trans('sidebar.department')}}</a></li>@endcan
							@can('Vehilce-Category')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-category.index')}}">{{trans('sidebar.vehicle_category')}}</a></li>@endcan
              @can('Vehicle-Type-Group')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-type-group.index')}}">{{trans('sidebar.vehicletype_group')}}</a></li>@endcan
							@can('Vehicle-Type')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-type.index')}}">{{trans('sidebar.vehicletype')}}</a></li>@endcan
							@can('Vehicle-Model')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-model.index')}}">{{trans('sidebar.vehiclemodel')}}</a></li>@endcan
							@can('Vehicle-Brand')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-brand.index')}}">{{trans('sidebar.vehiclebrand')}}</a></li>@endcan
							@can('Vehicle-Kind')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-kind.index')}}">{{trans('sidebar.vehiclekind')}}</a></li>@endcan
							
              @can('Steering')	<li class="nav-item"><a class="nav-link" href="{{route('steering.index')}}">{{trans('sidebar.steeting')}}</a></li>@endcan
							@can('Engine-Type')<li class="nav-item"><a class="nav-link" href="{{route('engine-type.index')}}">{{trans('sidebar.enginetype')}}</a></li>@endcan
							@can('Engine-Brand')<li class="nav-item"><a class="nav-link" href="{{route('engine-brand.index')}}">{{trans('sidebar.enginebrand')}}</a></li>@endcan
							@can('Application-Type')<li class="nav-item"><a class="nav-link" href="{{route('application-type.index')}}">{{trans('sidebar.applica_type')}}</a></li>@endcan
							
							@can('Application-Doc-Type')<li class="nav-item"><a class="nav-link" href="{{route('application-doc-type.index')}}">{{trans('sidebar.applica_doc_type')}}</a></li>@endcan
							@can('App-Purpose')<li class="nav-item"><a class="nav-link" href="{{route('app-purpose.index')}}">{{trans('sidebar.apppurpose')}}</a></li>@endcan
              @can('Working-Status-Group')	<li class="nav-item"><a class="nav-link" href="{{route('working-status-group.index')}}">{{trans('sidebar.working_status_group')}}</a></li>@endcan
              @can('Working-Status')	<li class="nav-item"><a class="nav-link" href="{{route('working-status.index')}}">{{trans('sidebar.working_status')}}</a></li>@endcan
              @can('Division')	<li class="nav-item"><a class="nav-link" href="{{route('division.index')}}">{{trans('sidebar.division')}}</a></li>@endcan
              @can('Money-Unit')	<li class="nav-item"><a class="nav-link" href="{{route('money-unit.index')}}">{{trans('sidebar.money_unit')}}</a></li>@endcan
							@can('Color')<li class="nav-item"><a class="nav-link" href="{{route('color.index')}}">{{trans('title.color')}}</a></li>@endcan
              @can('Inspect-Place')<li class="nav-item"><a class="nav-link" href="{{route('inspect-place.index')}}">{{trans('title.inspect_place')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
        @can('Vehicle-Management')
        <li class="nav-item @yield('vims')">
            <a class="nav-link" data-toggle="collapse" href="#mod4" aria-expanded="false" aria-controls="inspect">
            <i class="fa fa-taxi menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.vims')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="mod4">
              <ul class="nav flex-column sub-menu">
              @can('Application-Form')<li class="nav-item"><a class="nav-link" href="{{route('applications.index')}}">{{trans('sidebar.app_form')}}</a></li>@endcan
						
			      	@can('All-Vehicles')<li class="nav-item"><a class="nav-link" href="">{{trans('sidebar.all_vehicle')}}</a></li>@endcan
              @can('Vehicle-Transfer')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-transfer.index')}}">{{trans('sidebar.vehicle_transfer')}}</a></li>@endcan
				      @can('Vehicle-Inspection')<li class="nav-item"><a class="nav-link" href="{{route('vehicle-inspection.index')}}">{{trans('sidebar.vehicle_inspect')}}</a></li>@endcan
				      @can('Traffic-Police')<li class="nav-item"><a class="nav-link" href="{{route('traffic-police.index')}}">{{trans('sidebar.traffice_police')}}</a></li>@endcan
              @can('Document-Management')<li class="nav-item"><a class="nav-link" href="{{route('document-management.index')}}">{{trans('sidebar.doc_mang')}}</a></li>@endcan
              
              @can('License-Number-Control')<li class="nav-item"><a class="nav-link" href="{{route('sub-license-number-control.index')}}">{{trans('sidebar.lic_no_control')}}</a></li>@endcan
              @can('Alphabet-Control')<li class="nav-item"><a class="nav-link" href="{{route('alphabet-control.index')}}"> {{trans('sidebar.alphabet_control')}}</a></li>@endcan
              @can('License-Number-Sale')<li class="nav-item"><a class="nav-link" href="{{route('license-number-sale.index')}}"> {{trans('sidebar.lic_sale')}}</a></li>@endcan
              @can('License-Number-Not-Sale')<li class="nav-item"><a class="nav-link" href="{{route('license-number-not-sale.index')}}"> {{trans('sidebar.lic_not_sale')}}</a></li>@endcan
              @can('License-Number-Booking')<li class="nav-item"><a class="nav-link" href="{{route('license-number-booking.index')}}"> {{trans('sidebar.lic_booking')}}</a></li>@endcan
              @can('License-History')<li class="nav-item"><a class="nav-link" href="{{route('license-history.index')}}"> {{trans('sidebar.lic_history')}}</a></li>@endcan
              @can('License-Number-Present')<li class="nav-item"><a class="nav-link" href="{{route('license-no-present.index')}}"> {{trans('sidebar.lic_present')}}</a></li>@endcan
              @can('Division-Number-Control')<li class="nav-item"><a class="nav-link" href="{{route('division-no-control.index')}}"> {{trans('sidebar.division_control')}}</a></li>@endcan
              @can('Province-Number-Control')<li class="nav-item"><a class="nav-link" href="{{route('province-no-control.index')}}"> {{trans('sidebar.province_control')}}</a></li>@endcan
              @can('Alphabet')<li class="nav-item"><a class="nav-link" href="{{route('license-alphabet.index')}}"> {{trans('sidebar.alphabet')}}</a></li>@endcan
              @can('Alphabet-Control-Status')<li class="nav-item"><a class="nav-link" href="{{route('license-alphabet-control.index')}}"> {{trans('sidebar.alphabet_control_status')}}</a></li>@endcan
          
              </ul>
            </div>
          </li>
        @endcan
        @can('Technical-Inspect')
          <li class="nav-item @yield('tech')">
            <a class="nav-link" data-toggle="collapse" href="#inspect" aria-expanded="false" aria-controls="inspect">
            <i class="fa fa-cogs menu-icon" aria-hidden="true"></i>
              <span class="menu-title">{{trans('sidebar.technical_inspect')}} </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="inspect">
              <ul class="nav flex-column sub-menu">
               @can('Technical-Inspect') <li class="nav-item">
                <a class="nav-link" href="{{url('technical-inspect')}}">
                  {{trans('sidebar.technical_inspect')}}
                    </a>
                </li>@endcan
              </ul>
            </div>
          </li>
          @endcan
       
          @can('Vehicle-Import-Management')
          <li class="nav-item @yield('importer')">
            <a class="nav-link" data-toggle="collapse" href="#importer" aria-expanded="false" aria-controls="importer">
            <i class="mdi mdi-playlist-check menu-icon"></i>
              <span class="menu-title"> {{trans('sidebar.veh_import_man_sys')}} </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="importer">
              <ul class="nav flex-column sub-menu">
               @can('Import-Appliation-Lists') <li class="nav-item">
                  <a class="nav-link" href="{{url('/import-vehicle')}}">
                  {{trans('sidebar.import_app_list')}}
                    </a>
                </li>@endcan
              </ul>
            </div>
          </li>
          @endcan
          @can('Vehicle-Passport')
          <li class="nav-item @yield('register')">
            <a class="nav-link" data-toggle="collapse" href="#passport" aria-expanded="false" aria-controls="maps">
            <i class="fa fa-address-book menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.veh_passport')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="passport">
              <ul class="nav flex-column sub-menu">
                @can('New-Register')
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/search')}}">{{trans('sidebar.new_register')}}</a>
                </li>
                @endcan
                @can('Register-Lists')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('vehicle-passport.index')}}">{{trans('sidebar.register_list')}}</a>
                </li>
                @endcan
                @can('Printing-Passport-Reports')
                <li class="nav-item"><a class="nav-link"  href="{{route('print-passport-report.index')}}">{{trans('sidebar.passport_report')}}</a></li>
               @endcan
				<!-- <li class="nav-item"><a class="nav-link" href="{{url('report')}}"><span>{{trans('sidebar.report')}}</span></a></li>
								 -->
              </ul>
            </div>
          </li>
          @endcan
          @can('Report')
          <li class="nav-item @yield('report_static')">
            <a class="nav-link" data-toggle="collapse" href="#report" aria-expanded="false" aria-controls="report">
            <i class="mdi mdi-apple-keyboard-command menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.report_static')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="report">
              <ul class="nav flex-column sub-menu">
              {{-- <li><a href="{{route('importer.index')}}"><span>{{trans('importer.manage_imp')}}</span></a></li> --}}
              
					@can('User-Reports')<li class="nav-item" ><a class="nav-link"  href="{{route('user-report.index')}}">{{trans('sidebar.user_report')}}</a></li>@endcan
					
          @can('Pre-Registration-Reports')<li class="nav-item"><a class="nav-link"  href="{{route('pre-registration-report.index')}}">{{trans('sidebar.pre_reg_report')}}</a></li>@endcan
          @can('Transfer-Change-Info-Reports')<li class="nav-item"><a class="nav-link"  href="{{route('transfer-change-report.index')}}">{{trans('sidebar.transfer_report')}}</a></li>@endcan
          @can('Registration-Reports')<li class="nav-item"><a class="nav-link"  href="{{route('registration-report.index')}}">{{trans('sidebar.reg_report')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
          @can('Setting')
          <li class="nav-item @yield('setting')">
            <a class="nav-link" data-toggle="collapse" href="#d-setting" aria-expanded="false" aria-controls="display">
            <i class="fa fa-cog menu-icon" aria-hidden="true"></i>
              <span class="menu-title">{{trans('sidebar.setting')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="d-setting">
              <ul class="nav flex-column sub-menu">
              @can('Display-Setting') <li class="nav-item"><a class="nav-link" href="{{ route('display-setting.index') }}">{{trans('sidebar.display_setting')}}</a></li>@endcan
             @can('Smart-Cart-Setting') <li class="nav-item"><a class="nav-link" href="{{ url('/smartcard-setting') }}">{{trans('sidebar.smart_card_setting')}}</a></li>@endcan
             @can('Smart-Card-Logo-Sign') <li class="nav-item"><a class="nav-link" href="{{ url('/smart-card-sign') }}">{{trans('sidebar.smart_card_logo')}}</a></li>@endcan
              <!-- <li class="nav-item"><a class="nav-link" href="{{ url('/smart-card-logo') }}">Smart Card Logo</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ url('/smart-card-sign') }}">Smart Card Sign</a></li> -->
              </ul>
            </div>
          </li>
        @endcan
          @can('User-Manual-Guide')
          <li class="nav-item @yield('guide')">
            <a class="nav-link" data-toggle="collapse" href="#guide" aria-expanded="false" aria-controls="guide">
            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.user_manu_guide')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="guide">
              <ul class="nav flex-column sub-menu">
             @can('Customer-User-Guide') <li class="nav-item"><a class="nav-link" href="#">{{trans('sidebar.customer_user_guide')}}</a></li>@endcan
             @can('Officer-User-Guide')<li class="nav-item"><a class="nav-link" href="#">{{trans('sidebar.officer_user_guide')}}</a></li>@endcan
             @can('Vehicle-Api-Guide')<li class="nav-item"><a class="nav-link" href="{{url('/api-guide')}}">{{trans('sidebar.api_user_guide')}}</a></li>@endcan
             @can('SmartCard-Api-Guide')<li class="nav-item"><a class="nav-link" href="{{url('/smart-card-api-guide')}}">{{trans('sidebar.card_user_guide')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
          @can('Display')
          <li class="nav-item @yield('display')">
            <a class="nav-link" data-toggle="collapse" href="#display" aria-expanded="false" aria-controls="display">
            <i class="mdi mdi-airplay menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.display')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="display">
              <ul class="nav flex-column sub-menu">
              @can('Display-On-Screen')<li class="nav-item"><a class="nav-link" href="{{route('display-screen.display-screen',['id'=>auth()->user()->department_id])}}">{{trans('sidebar.display_onscreen')}}</a></li>@endcan
              @can('Manage-Display-Screen')<li class="nav-item"><a class="nav-link" href="{{route('manage-display-screen.index')}}">{{trans('sidebar.mang_display')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
        
          @can('Action-Log')
          <li class="nav-item @yield('active_log')">
            <a class="nav-link" data-toggle="collapse" href="#log" aria-expanded="false" aria-controls="log">
              <i class="mdi mdi-map-marker-outline menu-icon"></i>
              <span class="menu-title">{{trans('sidebar.action_log')}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="log">
              <ul class="nav flex-column sub-menu">
              {{-- <li class="nav-item"><a class="nav-link" href="{{route('importer.index')}}"><span>{{trans('importer.manage_imp')}}</span></a></li> --}}
							@can('Action-Log')<li class="nav-item"><a class="nav-link" href="{{ route('action-log.index') }}">{{trans('sidebar.action_log')}}</a></li>@endcan
              </ul>
            </div>
          </li>
          @endcan
        </ul>
      </nav>