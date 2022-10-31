<nav id="sidebar">
    <div class="sidebar_blog_1">
        <div class="sidebar-header">
            <div class="logo_section">
                <a href="index.html"><img class="logo_icon img-responsive"
                        src="{{ asset('themeAdmin/images/logo/logo_icon.png') }}" alt="#" /></a>
            </div>
        </div>
        <div class="sidebar_user_info">
            <div class="icon_setting"></div>
            <div class="user_profle_side">
                <div class="user_img"><img class="img-responsive" src="{{ asset(auth()->user()->avatar ?? '') }}"
                        alt="#" /></div>
                <div class="user_info">
                    <h6>{{ auth()->user()->name ?? '' }}</h6>
                    <p><span class="online_animation"></span> Online</p>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar_blog_2">
        <h4>General</h4>
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                        class="fa fa-dashboard yellow_color"></i> <span>Nhân Sự</span></a>
                <ul class="collapse list-unstyled" id="dashboard">
                    @can('viewAny', App\Models\User::class)
                        <li>
                            <a href="{{ route('users.index') }}">><span>Nhân viên</span></a>
                        </li>
                    @endcan
                    @can('viewAny', App\Models\Group::class)
                        <li>
                            <a href="{{ route('groups.index') }}">><span>Chức vụ</span></a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li>
                <a href="#element" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                        class="fa fa-diamond purple_color"></i> <span>Bán Hàng</span></a>
                <ul class="collapse list-unstyled" id="element">
                    @can('viewAny', App\Models\Category::class)
                        <li><a href="{{ route('categories.index') }}">> <span>Danh mục sản phẩm</span></a></li>
                    @endcan
                    @can('viewAny', App\Models\Category::class)
                        <li><a href="{{ route('products.index') }}">> <span>Sản phẩm</span></a></li>
                    @endcan
                    @can('viewAny', App\Models\Brand::class)
                        <li><a href="{{ route('brands.index') }}">> <span>Nhãn hiệu</span></a></li>
                    @endcan
                    <li><a href="{{ route('banners.index') }}">> <span>Ảnh bìa</span></a></li>
                </ul>
            </li>
            <li>
                <a href="#apps" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                        class="fa fa-object-group blue2_color"></i> <span>Khách hàng</span></a>
                <ul class="collapse list-unstyled" id="apps">
                    @can('viewAny', App\Models\Brand::class)
                    <li><a href="{{ route('customers.index') }}">> <span>Danh sách khách hàng</span></a></li>
                    @endcan
                    @can('viewAny', App\Models\Order::class)
                    <li><a href="{{ route('orders.index') }}">> <span>đơn hàng</span></a></li>
                    @endcan
                </ul>
            </li>
           
    </div>
</nav>
