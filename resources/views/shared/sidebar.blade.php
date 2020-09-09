<!-- ============================================================== -->
<!-- left sidebar -->
<!-- ============================================================== -->
<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Request::url() == route('home.index')) active @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1">
                            <i class="fa fa-fw fa-user-circle"></i>Dashboard
                            <span class="badge badge-success">6</span>
                        </a>
                        <div id="submenu-1" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('home.index') }}">Dashboard</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="../dashboard-sales.html">Sales</a>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::url() == route('clients.index')) active @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                            <i class="fa fa-fw fa-rocket"></i>{{__('Clientes')}}
                        </a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('clients.index')}}">{{__("Administrar")}}<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clients.create') }}">{{__('Registrar')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Request::url() == route('products.index')) active @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3">
                            <i class="fas fa-fw fa-chart-pie"></i>{{__('Productos')}}
                        </a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.index') }}">{{__("Administrar")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.create') }}">{{__('Registrar')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Request::url() == route('categories.index')) active @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4">
                            <i class="fab fa-fw fa-wpforms"></i>{{__('Categorias')}}
                        </a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.index') }}">{{__("Administrar")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('categories.create') }}">{{__('Registrar')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Request::url() == route('orders.index')) active @endif" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5">
                            <i class="fab fa-fw fa-wpforms"></i>{{__('Ordenes')}}
                        </a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.index') }}">{{__("Administrar")}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('orders.create') }}">{{__('Registrar')}}</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- ============================================================== -->
<!-- end left sidebar -->
<!-- ============================================================== -->
