@inject('constanst', 'App\Constant\Constanst')
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset(Auth::guard('web')->user()->getProfile->avatar) }}" class="img-circle elevation-2" alt="User Image">
                {{-- <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::guard('web')->user()->getProfile->full_name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item ">
                {{-- <li class="nav-item menu-open"> --}}
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Request::url() == $constanst::DASHBOARD_URL ?"active":"" }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <i class="right fas fa-angle-left"></i> --}}
                        </p>
                    </a>
                </li>
                @can('list-pms')
                <li class="nav-item {{in_array(Request::url(), [$constanst::PERMISSION_URL, $constanst::CREATE_PERMISSION_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Quy???n
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link {{ Request::url() == $constanst::PERMISSION_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-pms')
                        <li class="nav-item">
                            <a href="{{ route('permissions.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_PERMISSION_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list-role')
                <li class="nav-item {{ in_array(Request::url(), [$constanst::ROLE_URL, $constanst::CREATE_ROLE_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Vai tr??
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link {{ Request::url() == $constanst::ROLE_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-role')
                        <li class="nav-item">
                            <a href="{{ route('roles.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_ROLE_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list-cate')
                <li class="nav-item {{ in_array(Request::url(), [$constanst::CATEGORY_URL, $constanst::CREATE_CATEGORY_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Danh m???c s???n ph???m
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ Request::url() == $constanst::CATEGORY_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-cate')
                        <li class="nav-item">
                            <a href="{{ route('categories.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_CATEGORY_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list-attr')
                <li class="nav-item {{ in_array(Request::url(), [$constanst::ATTRIBUTE_URL, $constanst::CREATE_ATTRIBUTE_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Thu???c t??nh
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('attributes.index') }}" class="nav-link {{ Request::url() == $constanst::ATTRIBUTE_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-attr')
                        <li class="nav-item">
                            <a href="{{ route('attributes.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_ATTRIBUTE_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list-user')
                <li class="nav-item {{ in_array(Request::url(), [$constanst::USER_URL, $constanst::CREATE_USER_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            T??i kho???n
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ Request::url() == $constanst::USER_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-user')
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_USER_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('list-product')
                <li class="nav-item {{ in_array(Request::url(), [$constanst::PRODUCT_URL, $constanst::CREATE_PRODUCT_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            S???n ph???m
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}" class="nav-link {{ Request::url() == $constanst::PRODUCT_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch</p>
                            </a>
                        </li>
                        @can('add-product')
                        <li class="nav-item">
                            <a href="{{ route('products.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_PRODUCT_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcan

                {{-- @can('list-product') --}}
                <li class="nav-item {{ in_array(Request::url(), [$constanst::NEW_CATEGORY_URL, $constanst::NEW_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            B??i vi???t
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categoryNews.index') }}" class="nav-link {{ Request::url() == $constanst::NEW_CATEGORY_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch danh m???c b??i vi???t</p>
                            </a>
                        </li>
                        {{-- @can('add-product') --}}
                        <li class="nav-item">
                            <a href="{{ route('news.index') }}" class="nav-link {{ Request::url() == $constanst::NEW_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch b??i vi???t</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}

                {{-- @can('list-product') --}}
                <li class="nav-item {{ in_array(Request::url(), [$constanst::ORDER_STATUS_URL, $constanst::CREATE_ORDER_STATUS_URL]) ?"menu-is-opening menu-open":"" }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tr???ng th??i
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orderStatus.index') }}" class="nav-link {{ Request::url() == $constanst::ORDER_STATUS_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh s??ch tr???ng th??i</p>
                            </a>
                        </li>
                        {{-- @can('add-product') --}}
                        <li class="nav-item">
                            <a href="{{ route('orderStatus.create') }}" class="nav-link {{ Request::url() == $constanst::CREATE_ORDER_STATUS_URL ?"active":"" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Th??m</p>
                            </a>
                        </li>
                        {{-- @endcan --}}
                    </ul>
                </li>
                {{-- @endcan --}}

                {{-- @can('list-product') --}}
                <li class="nav-item ">
                    <a href="{{ route('orders.index') }}" style="{{ in_array(Request::url(), [$constanst::ORDER_URL]) ?"active":"" }}?background-color: rgba(255,255,255,.1):'';" class="nav-link">
                    {{-- <a href="{{ route('orders.index') }}" class="nav-link {{ in_array(Request::url(), [$constanst::ORDER_URL]) ?"active":"" }}"> --}}
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            ????n h??ng
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                </li>
                {{-- @endcan --}}

         
                {{-- <li class="nav-header">EXAMPLES</li>
                <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/kanban.html" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Kanban Board
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/profile.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/e-commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E-commerce</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/projects.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-add.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-edit.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project-detail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/contacts.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/faq.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>FAQ</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/contact-us.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contact us</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Extras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Login & Register v1
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/login.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/register.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Register v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/forgot-password.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Forgot Password v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/recover-password.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recover Password v1</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Login & Register v2
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/examples/login-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Login v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/register-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Register v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/forgot-password-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Forgot Password v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/examples/recover-password-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recover Password v2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/lockscreen.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lockscreen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Legacy User Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/language-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Language Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/404.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 404</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/500.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 500</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/pace.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pace</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/blank.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blank Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="starter.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Starter Page</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            Search
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/search/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Search</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/search/enhanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enhanced</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item"> --}}


                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="nav-link">

                            <i class="fa-solid fa-right-from-bracket"></i>
                            <button class="btn btn-info">
                                Logout
                            </button>
                        </a>
                    </form>

                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
