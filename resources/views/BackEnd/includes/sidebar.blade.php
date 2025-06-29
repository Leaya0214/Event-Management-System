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
            @if (check_permission('dashboard.view'))
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
            @endif
            @if (check_permission('staticContent.list') ||
                    check_permission('slider.list') ||
                    check_permission('service.list') ||
                    check_permission('blog.list') ||
                    check_permission('teamMember.list') ||
                    check_permission('teamMember.list.list') ||
                    check_permission('staticContent.list' || check_permission('clientReview.list')))
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
                @if (check_permission('slider.list'))
                    <li class="nav-item {{ request()->is('slider', 'slider/*') ? '' : '' }}">
                        <a href="{{ route('slider') }}" class="nav-link">
                            <i class="fa-solid fa-sliders link-icon"></i>
                            <span class="link-title">Sliders</span>
                        </a>
                    </li>
                @endif
                @if (check_permission('service.list'))
                    <li class="nav-item {{ request()->is('service', 'service/*') ? 'active' : '' }}">
                        <a href="{{ route('service') }}" class="nav-link">
                            <i class="fa-solid fa-handshake link-icon"></i>
                            <span class="link-title">Services</span>
                        </a>
                    </li>
                @endif
                @if (check_permission('blog.list'))
                    <li class="nav-item {{ request()->is('blog', 'blog/*') ? 'active' : '' }}">
                        <a href="{{ route('blog') }}" class="nav-link ">
                            <svg class="link-icon" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            <span class="link-title">Blog</span>
                        </a>
                    </li>
                @endif
                @if (check_permission('teamMember.list'))
                    <li class="nav-item {{ request()->is('member', 'member/*') ? 'active' : '' }}">
                        <a href="{{ route('member') }}" class="nav-link ">
                            <i class="fa-solid fa-users link-icon"></i>
                            <span class="link-title">Team Members</span>
                        </a>
                    </li>
                @endif
                @if (check_permission('clientReview.list'))
                    <li class="nav-item {{ request()->is('client_review', 'client_review/*') ? 'active' : '' }}">
                        <a href="{{ route('client_review') }}" class="nav-link ">
                            <i class="fa-regular fa-comment link-icon"></i>
                            <span class="link-title">Client Reviews</span>
                        </a>
                    </li>
                @endif
                @if (check_permission('staticContent.list'))
                    <li class="nav-item {{ request()->is('content', 'content/*') ? 'active' : '' }}">
                        <a href="{{ route('content') }}" class="nav-link">
                            <i class="fa-solid fa-globe link-icon "></i>
                            <span class="link-title">Static Content</span>
                        </a>
                    </li>
                @endif
            @endif

            @if (check_permission('portfolio.list'))
                <li class="nav-item nav-category">Portfolio</li>
                <li class="nav-item {{ request()->is('portfolio_category') ? 'active' : '' }} ">
                    <a href="{{ route('portfolio.category') }}" class="nav-link">
                        <i class="fa-solid fa-briefcase link-icon"></i>
                        <span class="link-title">Portfolio Category</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('portfolio', 'portfolio/*') ? 'active' : '' }}">
                    <a href="{{ route('portfolio') }}" class="nav-link">
                        <i class="fa-solid fa-briefcase link-icon"></i>
                        <span class="link-title">Portfolio</span>
                    </a>
                </li>
            @endif
            @if (check_permission('branch.list') ||
                    check_permission('package.list') ||
                    check_permission('category.list') ||
                    check_permission('packageType.list'))
                <li class="nav-item nav-category">Package</li>

                <li class="nav-item ">
                    <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false"
                        aria-controls="forms">
                        <i class="link-icon" data-feather="inbox"></i>
                        <span class="link-title">Packages</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav sub-menu">
                            @if (check_permission('branch.list'))
                                <li class="nav-item {{ request()->is('package_branch') ? 'active' : '' }}">
                                    <a href="{{ route('package_branch') }}" class="nav-link">Branch</a>
                                </li>
                            @endif
                            @if (check_permission('packageType.list'))
                                <li class="nav-item {{ request()->is('package_type') ? 'active' : '' }}">
                                    <a href="{{ route('package_type') }}" class="nav-link">Package Type</a>
                                </li>
                            @endif
                            @if (check_permission('category.list'))
                                <li class="nav-item {{ request()->is('package_category') ? 'active' : '' }}">
                                    <a href="{{ route('package_category') }}" class="nav-link">Package Category</a>
                                </li>
                            @endif
                            @if (check_permission('package.list'))
                                <li class="nav-item {{ request()->is('all_package/*') ? 'active' : '' }}">
                                    <a href="{{ route('package') }}" class="nav-link">Package</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif
            @if (check_permission('district.list') ||
                    check_permission('shift.list') ||
                    check_permission('eventType.list') ||
                    check_permission('event.list'))
                <li class="nav-item nav-category">Events</li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="collapse" href="#events" role="button"
                        aria-expanded="false" aria-controls="forms">
                        <i class="link-icon" data-feather="anchor"></i>
                        <span class="link-title">Event</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                        {{-- <i class="link-arrow" data-feather="chevron-down"></i> --}}
                    </a>
                    <div class="collapse" id="events">
                        <ul class="nav sub-menu">
                            @if (check_permission('district.list'))
                                <li class="nav-item">
                                    <a href="{{ route('district') }}" class="nav-link">Event District</a>
                                </li>
                            @endif
                            @if (check_permission('shift.list'))
                                <li class="nav-item">
                                    <a href="{{ route('shift') }}" class="nav-link">Event Shift</a>
                                </li>
                            @endif
                            @if (check_permission('eventType.list'))
                                <li class="nav-item">
                                    <a href="{{ route('event_type') }}" class="nav-link">Event Type</a>
                                </li>
                            @endif
                            @if (check_permission('event.list'))
                                <li class="nav-item  {{ request()->is('event_info') ? 'active' : '' }}">
                                    <a href="{{ route('event_info') }}" class="nav-link">Manage Event</a>
                                </li>
                            @endif
                          
                        </ul>
                    </div>
                </li>
            @endif
            @if (check_permission('client.list') || check_permission('client.delete'))
                <li class="nav-item  {{ request()->is('client-index') ? 'active' : '' }}">
                    <a href="{{route('client-index')}}" class="nav-link">
                        <i class="fa-solid fa-circle-info link-icon"></i>
                        <span class="link-title">Client Details</span>
                    </a>
                </li>
            @endif
                
            @if (check_permission('single.event.list'))      
                <li class="nav-item {{ request()->is('singleevent-list') ? 'active' : '' }}">
                    <a href="{{route('singleevent-list')}}" class="nav-link">
                        <i class="fa-solid fa-list link-icon"></i>
                        <span class="link-title">Single Event List</span>
                    </a>
                </li>
            @endif
                @if (check_permission('assignevent.list'))      
                <li class="nav-item {{ request()->is('assign-list') ? 'active' : '' }}">
                    <a href="{{route('assign-list')}}" class="nav-link">
                        <i class="fa-solid fa-list link-icon"></i>
                        <span class="link-title">Assigned Event List</span>
                    </a>
                </li>
            @endif
            @if (check_permission('clientpayment.list') || check_permission('stuffpayment.list'))
                <li class="nav-item nav-category">Payment History</li>
                <li class="nav-item {{ request()->is('client.payment') ? 'active' : '' }}">
                    <a href="{{route('client.payment')}}" class="nav-link">
                        <i class="fa-solid fa-file-invoice link-icon"></i>
                        <span class="link-title">Client Payment List</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('payment.staff') ? 'active' : '' }}">
                    <a href="{{route('payment.staff')}}" class="nav-link">
                        <i class="fa-solid fa-file-invoice link-icon"></i>
                        <span class="link-title">Staff Payment List</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->is('payment.history') ? 'active' : '' }}">
                    <a href="{{route('payment.history')}}" class="nav-link">
                        <i class="fa-solid fa-file-invoice link-icon"></i>
                        <span class="link-title">Staff Payment Report</span>
                    </a>
                </li>
            @endif
            @if (check_permission('account.category.add')||check_permission('account.category.edit') ||check_permission('account.category.list')||check_permission('expense.list') ||check_permission('balance.sheet') )
             <li class="nav-item nav-category">Accounts</li>
             @endif
             @if (check_permission('account.category.list'))
                <li class="nav-item">
                    <a href="{{route('expense.category')}}" class="nav-link{{ request()->is('expense.category') ? 'active' : '' }} ">
                        <i class="fa-solid fa-layer-group link-icon"></i>
                        <span class="link-title">Account Category</span>
                    </a>
                </li> 
                @endif
                <!--@if (check_permission('expense.add'))-->
                <!--<li class="nav-item">-->
                <!--    <a href="{{route('expense.add')}}" class="nav-link{{ request()->is('expense.add') ? 'active' : '' }}">-->
                <!--        <i class="fa-solid fa-arrow-right-to-bracket link-icon"></i>-->
                <!--        <span class="link-title">Expense Entry</span>-->
                <!--    </a>-->
                <!--</li> -->
                <!--@endif-->
                @if (check_permission('expense.list'))
                <li class="nav-item ">
                    <a href="{{route('expense.index')}}" class="nav-link {{ request()->is('expense.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-list-check link-icon"></i>
                        <span class="link-title">Manage Expense</span>
                    </a>
                </li>
                @endif
                 @if (check_permission('income.list'))
            
                <li class="nav-item">
                    <a href="{{route('income.index')}}" class="nav-link{{ request()->is('income.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-list link-icon"></i>
                        <span class="link-title">Manage Incomes </span>
                    </a>
                </li>

                @endif
                @if (check_permission('balance.sheet') )
                <li class="nav-item ">
                    <a href="{{route('balance.sheet')}}" class="nav-link  {{ request()->is('balance.sheet') ? 'active' : '' }}">
                        <i class="fa-solid fa-scale-balanced link-icon"></i>
                        <span class="link-title">Balance Sheet</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{route('report.daily.ledger')}}" class="nav-link  {{ request()->is('report.daily.ledger') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-lines link-icon"></i>
                        <span class="link-title">Daily Ledger</span>
                    </a>
                </li>
                @endif
                @if (check_permission('single.event.report'))
                <li class="nav-item ">
                    <a href="{{route('single.report.event')}}" class="nav-link  {{ request()->is('single.report.event') ? 'active' : '' }}">
                        <i class="fa-solid fa-file link-icon"></i>         
                       <span class="link-title">Single Event Report</span>
                    </a>
                </li>
                @endif
                @if (check_permission('all.event.report'))
                <li class="nav-item ">
                    <a href="{{route('report.event')}}" class="nav-link  {{ request()->is('report.event') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-circle-plus link-icon"></i>
                        <span class="link-title">All Event Report</span>
                    </a>
                </li>
                @endif
            @if (check_permission('user.list'))
                <li class="nav-item nav-category">User Management</li>
                <li class="nav-item {{ request()->is('users', 'user', 'user/*') ? 'active' : '' }}">
                    <a href="{{ route('user') }}" class="nav-link ">
                        <i class="fa-solid fa-user link-icon"></i>
                        <span class="link-title">Manage User</span>
                    </a>
                </li>
            @endif
            @if (check_permission('role.list'))
                <li class="nav-item {{ request()->is('role', 'role/*') ? 'active' : '' }}">
                    <a href="{{ route('role') }}" class="nav-link">
                        <i class="fa-solid fa-key link-icon"></i>
                        <span class="link-title">Manage Role</span>
                    </a>
                </li>
            @endif
            @if (check_permission('stuff.list'))
                <li class="nav-item">
                    <a href="{{ route('stuff') }}" class="nav-link">
                        <i class="fa-solid fa-users link-icon"></i>
                        <span class="link-title">Manage Stuff</span>
                    </a>
                </li>
            @endif
            @if (check_permission('systemSetting.view'))
                <li class="nav-item nav-category">Advance Settings</li>
                <li class="nav-item">
                    <a href="{{ route('system.setting') }}" class="nav-link">
                        <i class="fa-solid fa-gear link-icon"></i>
                        <span class="link-title">System Settings</span>
                    </a>
                </li>
            @endif
            @if (check_permission('sms.send'))
                <li class="nav-item">
                    <a href="{{route('sms')}}" class="nav-link">
                        <i class="fa-solid fa-message link-icon"></i>
                        <span class="link-title">Send Sms</span>
                    </a>
                </li>
            @endif
            @if (check_permission('cache.clear'))
                <li class="nav-item">
                    <a href="{{ url('clear') }}" class="nav-link">
                        <i class="fa-solid fa-rotate link-icon"></i>
                        <span class="link-title">Clear Cache</span>
                    </a>
                </li>
            @endif
            {{-- Stuff Panel --}}
            @if (check_permission('stuffEvent.list')||check_permission('stuffEvent.view') )
            <li class="nav-item {{request()->is('stuff.event') ? 'active' : ''}}">
                <a href="{{route('stuff.event') }}" class="nav-link">
                    <i class="fa-solid fa-list link-icon"></i>
                    <span class="link-title">Events</span>
                </a>
            </li>
            @endif
            @if (check_permission('payment.list')||check_permission('payment.view') )
            <li class="nav-item {{request()->is('stuff.payment') ? 'active' : ''}}">
                <a href="{{route('stuff.payment') }}" class="nav-link">
                    <i class="fa-solid fa-file-invoice link-icon"></i>
                    <span class="link-title">Payment</span>
                </a>
            </li>
            @endif
            {{-- Stuff panel end --}}
        </ul>
    </div>
</nav>
