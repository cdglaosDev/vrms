<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/home') }}"><img src="/images/logo1.png" alt="logo" height="42"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/home') }}"><img src="/images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          @if(auth()->user()->user_status == "all" || auth()->user()->user_status == "counter_calling")
            @include('Display.index')
          @else
          @endif
        </li>
        @php $locale = session()->get('locale'); @endphp
        <li class="nav-item dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
  
                        @switch($locale)
                               @case('en')
                               <img src="{{asset('images/en_flag.png')}}" width="30px" height="20x"> Eng
                               
                               @break
                               @default
                               <img src="{{asset('images/la_flag.png')}}" width="30px" height="20x"> Lao
                           @endswitch
                   </a>
                   <div class="dropdown-menu dropdown-menu-right">
                   <a href="{{url('lang/la')}}" class="dropdown-item"><img src="{{asset('images/la_flag.png')}}" width="30px" height="20x"> Lao</a>
                       <a href="{{url('lang/en')}}" class="dropdown-item"><img src="{{asset('images/en_flag.png')}}" width="30px" height="20x"> Eng</a>
                       
                   </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline mx-0"></i>
              <span class="unreadcount">{{ auth()->user()->notifications->count()}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have <span class="unreadcount">{{ auth()->user()->notifications->count()}}</span> new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                
                <div class="preview-item-content">
                 
                </div>
              </a>
            </div>
          </li>
          @if(Auth::check())
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <span class="d-none d-md-inline">{{Auth::user()->name}}</span> <i class="fa fa-caret-square-o-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ url('users',auth()->id()) }}">
              <i class="fa fa-user-o text-primary"></i>
                Profile
              </a>
              <a class="dropdown-item" href="{{url('change-password')}}">
                <i class="mdi mdi-settings text-primary"></i>
                Change Password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon dripicons-lock"></i>
                                       
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
            </div>
          </li>
          @endif
        
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>