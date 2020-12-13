<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-info">
        <div class="profile">
            <img src="{{ asset(Auth::user()->image) }}" alt="">
        </div>
        <div class="details">
            <p class="user-name">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</p>
            <p class="designation">{{ Auth::user()->type }}</p>
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('seller.home') }}">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#shop" aria-expanded="false" aria-controls="shop">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{{ __('Shop') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="shop">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.shop') }}">{{ __('Add a new Shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.shop') }}">{{ __('Shops') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{{ __('Product') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.product') }}">{{ __('Add a new Product') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.product') }}">{{ __('Products') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>