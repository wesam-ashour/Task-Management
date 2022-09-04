<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3">
                    <input type="text" class="form-control" placeholder="Search ..."
                           aria-label="Recipient's username">
                </form>
            </div>
        </li>
        <li class="dropdown notification-list topbar-dropdown" >
                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{asset('assets/images/flags/language.png')}}" alt="user-image" class="uil uil-arrow-growth" height="25">
                            <span class="align-middle d-none d-sm-inline-block">
                                @if(LaravelLocalization::getCurrentLocale() == 'ar')
                                    العربية
                                @else
                                English
                                @endif
                            </span> <i
                                class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <!-- item-->
                            <a hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                               class="dropdown-item notify-item">
                                {{ $properties['native'] }}
                            </a>
                            @endforeach
                        </div>

{{--            <ul>--}}
{{--                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)--}}
{{--                    <li>--}}
{{--                        <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"--}}
{{--                           href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">--}}
{{--                            {{ $properties['native'] }}--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                @if($notifications->count() >= 1 )
                    <span class="noti-icon-badge"></span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

                <!-- item-->
                <div class="dropdown-item noti-title">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="{{route('markAllAsRead')}}" class="text-dark">
                                <small>Clear All</small>
                            </a>
                        </span>Notification
                    </h5>
                </div>

                <div>
                    <!-- item-->
                    @forelse($notifications as $notification)
                        <a href="" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            @if($user->hasRole('Admin'))
                                <p class="notify-details">
                                    Username:
                                    [{{ $notification->data['name'] }}],<br> Email: [{{ $notification->data['email'] }}]<br>
                                    has been registered.
                                    <small class="text-muted">at [{{ $notification->created_at }}]</small>
                                    <br>
                                <form action="{{ route('notifications.update', $notification) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="submit" class="btn btn-sm btn-info" value="Mark as read">
                                </form>
                                </p>
                            @else
                                {{--                                <p class="notify-details">--}}
                                {{--                                    Username:--}}
                                {{--                                    [{{ $notification->data['title'] }}]--}}
                                {{--                                    has been registered.--}}
                                {{--                                    <small class="text-muted">at [{{ $notification->created_at }}]</small>--}}
                                {{--                                    <br>--}}
                                {{--                                <form action="{{ route('notifications.update', $notification) }}" method="POST">--}}
                                {{--                                    @csrf--}}
                                {{--                                    @method('PUT')--}}
                                {{--                                    <input type="submit" class="btn btn-sm btn-info" value="Mark as read">--}}
                                {{--                                </form>--}}
                                {{--                                </p>--}}
                            @endif
                        </a>
                    @empty
                        <p>There are no new notifications</p>
                    @endforelse
                    <a href="#" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                    </a>
                </div>
        </li>


        <li class="dropdown notification-list d-none d-sm-inline-block">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button"
               aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-view-apps noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg p-0">

                <div class="p-2">
                    <div class="row g-0">
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/images/brands/slack.png')}}" alt="slack">
                                <span>Slack</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/images/brands/github.png')}}" alt="Github">
                                <span>GitHub</span>
                            </a>
                        </div>
                        <div class="col">
                            <a class="dropdown-icon-item" href="#">
                                <img src="{{asset('assets/images/brands/dribbble.png')}}" alt="dribbble">
                                <span>Dribbble</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
               role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="account-user-avatar">
                                        <img src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="user-image"
                                             class="rounded-circle">
                                    </span>
                <span>
                                        <span class="account-user-name">{{$user->name}}</span>

                                        <span class="account-position">{{$user->roles->pluck('name') [0] ?? ''}}</span>
                                    </span>
            </a>
            <div
                class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a>

                <form id="logout-form" action="{{ url('logout') }}" method="POST">
                    {{ csrf_field() }}
                    <!-- item-->
                    <a href="{{ url('logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                       class="dropdown-item notify-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Logout</span>
                    </a>
                </form>

            </div>
        </li>


    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    {{--            <div class="app-search dropdown d-none d-lg-block">--}}
    {{--                <form>--}}
    {{--                    <div class="input-group">--}}
    {{--                        <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">--}}
    {{--                        <span class="mdi mdi-magnify search-icon"></span>--}}
    {{--                        <button class="input-group-text btn-primary" type="submit">Search</button>--}}
    {{--                    </div>--}}
    {{--                </form>--}}

    {{--                <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">--}}
    {{--                    <!-- item-->--}}
    {{--                    <div class="dropdown-header noti-title">--}}
    {{--                        <h5 class="text-overflow mb-2">Found <span class="text-danger">17</span> results</h5>--}}
    {{--                    </div>--}}

    {{--                    <!-- item-->--}}
    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
    {{--                        <i class="uil-notes font-16 me-1"></i>--}}
    {{--                        <span>Analytics Report</span>--}}
    {{--                    </a>--}}

    {{--                    <!-- item-->--}}
    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
    {{--                        <i class="uil-life-ring font-16 me-1"></i>--}}
    {{--                        <span>How can I help you?</span>--}}
    {{--                    </a>--}}

    {{--                    <!-- item-->--}}
    {{--                    <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
    {{--                        <i class="uil-cog font-16 me-1"></i>--}}
    {{--                        <span>User profile settings</span>--}}
    {{--                    </a>--}}

    {{--                    <!-- item-->--}}
    {{--                    <div class="dropdown-header noti-title">--}}
    {{--                        <h6 class="text-overflow mb-2 text-uppercase">Users</h6>--}}
    {{--                    </div>--}}

    {{--                    <div class="notification-list">--}}
    {{--                        <!-- item-->--}}
    {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
    {{--                            <div class="d-flex">--}}
    {{--                                <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-2.jpg"--}}
    {{--                                     alt="Generic placeholder image" height="32">--}}
    {{--                                <div class="w-100">--}}
    {{--                                    <h5 class="m-0 font-14">Erwin Brown</h5>--}}
    {{--                                    <span class="font-12 mb-0">UI Designer</span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}

    {{--                        <!-- item-->--}}
    {{--                        <a href="javascript:void(0);" class="dropdown-item notify-item">--}}
    {{--                            <div class="d-flex">--}}
    {{--                                <img class="d-flex me-2 rounded-circle" src="assets/images/users/avatar-5.jpg"--}}
    {{--                                     alt="Generic placeholder image" height="32">--}}
    {{--                                <div class="w-100">--}}
    {{--                                    <h5 class="m-0 font-14">Jacob Deo</h5>--}}
    {{--                                    <span class="font-12 mb-0">Developer</span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </a>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
</div>
<!-- end Topbar -->

