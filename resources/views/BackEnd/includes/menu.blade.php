<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Bridal <span><b>Harmony</b></span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{route('admin.index')}}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">website content</li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button"
                    aria-expanded="false" aria-controls="emails">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Email</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="emails">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/read.html" class="nav-link">Read</a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/email/compose.html" class="nav-link">Compose</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item {{ request()->is('slider','slider/*') ? '' : ''}}">
                <a href="{{route('slider')}}" class="nav-link">
                    <i class="fa-solid fa-sliders link-icon"></i>
                   <span class="link-title">Sliders</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('service','service/*') ? 'active' : ''}}">
                <a href="{{route('service')}}" class="nav-link">
                    <i class="fa-solid fa-handshake link-icon"></i>
                   <span class="link-title">Services</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('blog','blog/*') ? 'active' : ''}}">
                <a href="{{route('blog')}}" class="nav-link ">
                    <svg class="link-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span class="link-title">Blog</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('client_review','client_review/*') ? 'active' : ''}}">
                <a href="{{route('client_review')}}" class="nav-link ">
                    <i class="fa-regular fa-comment link-icon"></i>
                    <span class="link-title">Client Reviews</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('portfolio','portfolio/*') ? 'active' : ''}}">
                <a href="{{route('portfolio')}}" class="nav-link">
                    <i class="fa-solid fa-briefcase link-icon"></i>
                <span class="link-title">Portfolio</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('content','content/*') ? 'active' : ''}}">
                <a href="{{route('content')}}" class="nav-link">
                    <i class="fa-solid fa-globe link-icon "></i>
                    <span class="link-title">Static Content</span>
                </a>
            </li>
            
            <li class="nav-item nav-category">Events</li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                    aria-expanded="false" aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Event</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="pages/ui-components/accordion.html" class="nav-link">Accordion</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="anchor"></i>
                    <span class="link-title">Event</span>
                    {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false"
                    aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Packages</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('package_branch') }}" class="nav-link">Branch</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('package_type') }}" class="nav-link">Package Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('package_category') }}" class="nav-link">Package Category</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('package') }}" class="nav-link">Package</a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">User Management</li>
           <li class="nav-item {{ request()->is('role','role/*') ? 'active' : ''}}">
                <a href="{{route('role')}}"
                    class="nav-link">
                    <i class="fa-solid fa-key link-icon"></i>
                     <span class="link-title">Role</span>
                </a>
            </li>
            <li class="nav-item {{ request()->is('users','user','user/*') ? 'active' : ''}}">
                <a href="{{route('user')}}"
                    class="nav-link ">
                    <i class="fa-solid fa-user link-icon"></i>
                    <span class="link-title">Create User</span>
                </a>
            </li>
                <li class="nav-item">
                <a href=""
                    class="nav-link">
                    <i class="fa-solid fa-users link-icon"></i>
                     <span class="link-title">Manage Stuff</span>
                </a>
            </li>
            <li class="nav-item nav-category">Advance Settings</li>
            <li class="nav-item">
                <a href="{{route('system.setting')}}"
                    class="nav-link">
                    <i class="fa-solid fa-gear link-icon"></i>
                    <span class="link-title">System Settings</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('clear') }}"
                    class="nav-link">
                    <i class="fa-solid fa-rotate link-icon"></i>
                     <span class="link-title">Clear Cache</span>
                </a>
            </li>
        </ul>
    </div>
</nav>