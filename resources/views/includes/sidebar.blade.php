

<div id="left-sidebar" class="sidebar">
    <div class="user-account p-3">
        <div class="d-flex mb-3 pb-3 border-bottom align-items-center">
            <img src="https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-512.png" class="avatar lg rounded me-3" alt="User Profile Picture">
            <div class="dropdown flex-grow-1">
                <span class="d-block">Welcome
                    
                </span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-bs-toggle="dropdown"><strong>{{Auth::user()->fname}} {{Auth::user()->lname}}</strong></a>
                <ul class="dropdown-menu p-2 shadow-sm">
                    <li><a href="{{route('profile.index')}}"><i class="fa fa-user me-2"></i>My Profile</a></li>
                    <li class="divider"></li>
                    <li><a href="{{route('logout')}}"><i class="fa fa-power-off me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- nav tab: menu list -->
    <ul class="nav nav-tabs text-center mb-2" role="tablist">
        <li class="nav-item flex-fill"><a class="nav-link active" data-bs-toggle="tab" href="#hr_menu" role="tab">HR</a></li>
        <li class="nav-item flex-fill"><a class="nav-link" data-bs-toggle="tab" href="#setting_menu" role="tab"><i class="fa fa-cog"></i></a></li>
    </ul>
    <!-- nav tab: content -->
    <div class="tab-content px-0">
        <div class="tab-pane fade show active" id="hr_menu" role="tabpanel" >
            <nav class="sidebar-nav">
                <ul class="metismenu list-unstyled">
                    <li class="{{Request::is('dashboard*') ? 'active' : '' }}"><a href="{{route('dashboard')}}"><i class="fa fa-tachometer"></i><span>HR Dashboard</span></a></li>
                    @can('view holidays')
                    <li class="{{Request::is('holidays*') ? 'active' : '' }}"><a href="{{route('holidays.all')}}"><i class="fa fa-list-ul"></i>Holidays</a></li>
                    @endcan
                    @can('view employees')
                    <li class="{{Request::is('employees*') ? 'active' : '' }}"><a href="{{route('employees.all')}}"><i class="fa fa-users"></i>Employees</a></li>
                    @endcan
                    @can('view departments')
                    <li class="{{Request::is('departments*') ? 'active' : '' }}"><a href="{{route('departments.all')}}"><i class="fa fa-sitemap"></i>Departments</a></li>
                    @endcan
                    @can('view users')
                    <li class="{{Request::is('users*') ? 'active' : '' }}"><a href="{{route('users.all')}}"><i class="fa fa-users"></i>Users</a></li>   
                    @endcan                    
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade" id="setting_menu" role="tabpanel" >
            <div class="px-3">
                <h6>Choose Skin</h6>
                <ul class="choose-skin list-unstyled">
                    <li data-theme="purple" class="mb-2"><div class="purple"></div><span>Purple</span></li>
                    <li data-theme="blue" class="mb-2"><div class="blue"></div><span>Blue</span></li>
                    <li data-theme="cyan" class="mb-2"><div class="cyan"></div><span>Cyan</span></li>
                    <li data-theme="green" class="mb-2"><div class="green"></div><span>Green</span></li>
                    <li data-theme="orange" class="mb-2"><div class="orange"></div><span>Orange</span></li>
                    <li data-theme="blush" class="mb-2"><div class="blush"></div><span>Blush</span></li>
                </ul>
                <hr>
                <h6>Theme Option</h6>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center mb-1">
                        <div class="form-check form-switch theme-switch">
                            <input class="form-check-input" type="checkbox" id="theme-switch">
                            <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                        </div>
                    </li>
                    <li class="d-flex align-items-center mb-1">
                        <div class="form-check form-switch theme-high-contrast">
                            <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                            <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                        </div>
                    </li>
                </ul>
                <hr>
            </div>
        </div>
    </div>
</div>