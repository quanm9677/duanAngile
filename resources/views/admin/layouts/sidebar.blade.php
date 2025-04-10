<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm">
        <div class="container-fluid p-0">
            <div id="main-menu" class="w-100">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa fa-home"></i>
                            <span>Trang Chủ</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                            <i class="fa fa-th-large"></i>
                            <span>Danh mục sản phẩm</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.comics.index') }}" class="nav-link {{ request()->routeIs('admin.comics.*') ? 'active' : '' }}">
                            <i class="fa fa-book"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-list-alt"></i>
                            <span>Danh sách đơn hàng</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-calendar"></i>
                            <span>Quản lí khuyến mãi</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-comments"></i>
                            <span>Quản lí Bình luận</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-star"></i>
                            <span>Quản lí Đánh giá</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-picture-o"></i>
                            <span>Quản lí Banner</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa fa-users"></i>
                            <span>Quản lí tài khoản</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i>
                            <span>Đăng xuất</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</aside>