<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- LOGO -->
    <a href="index.html" class="logo text-center logo-light">
                    <span class="logo-lg" style="font-size: 17px;">
                        <img src="{{asset('assets/images/logo.png')}}" alt="" height="35"> Tasks Management
                    </span>
        <span class="logo-sm">
                        <img src="{{asset('assets/images/logo.png')}}" alt="" height="20">
                    </span>
    </a>

    <div class="h-100" id="leftside-menu-container" data-simplebar="">

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">{{ __('sentence.navigation') }}</li>

            <li class="side-nav-item">
                <a href="{{route('dashboard')}}" class="side-nav-link active">
                    <i class="uil-home-alt"></i>
                    <span> {{ __('sentence.dashboard') }} </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="/" class="side-nav-link">
                    <i class="uil-bell"></i>
                    <span> {{ __('sentence.notifications') }} </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('users.index')}}" class="side-nav-link">
                    <i class="uil-user"></i>
                    <span> {{ __('sentence.users') }} </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('roles.index')}}" class="side-nav-link">
                    <i class="uil-lock"></i>
                    <span> {{ __('sentence.roles') }} </span>
                </a>
            </li>

            <li class="side-nav-title side-nav-item">{{ __('sentence.custom') }}</li>

            <li class="side-nav-item">
                <a href="{{route('clients.index')}}" class="side-nav-link">
                    <i class="uil-user-plus"></i>
                    <span> {{ __('sentence.clients') }} </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('projects.index')}}" class="side-nav-link">
                    <i class="uil-chart-pie"></i>
                    <span> {{ __('sentence.projects') }} </span>
                </a>
            </li>

            <li class="side-nav-item">
                <a href="{{route('tasks.index')}}" class="side-nav-link">
                    <i class="uil-notes"></i>
                    <span> {{ __('sentence.tasks') }} </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
