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
            <a class="nav-link" href="{{ route('admin.home') }}">
                <i class="mdi mdi-file-document-box menu-icon"></i>
                <span class="menu-title">{{ __('Dashboard') }}</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#brand" aria-expanded="false" aria-controls="brand">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{{ __('Brand') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="brand">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.brand') }}">{{ __('Add a new Brand') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.brand') }}">{{ __('Brands') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#category" aria-expanded="false" aria-controls="category">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{{ __('Category') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="category">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('add.category') }}">{{ __('Add a new Category') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.category') }}">{{ __('Categories') }}</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#seller" aria-expanded="false" aria-controls="seller">
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                <span class="menu-title">{{ __('Seller') }}</span>
                <i class="mdi mdi-chevron-down menu-arrow"></i>
            </a>
            <div class="collapse" id="seller">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('approve.seller') }}">{{ __('Approve Sellers') }}<span style="margin-left: 5px; text-align: center; border-radius: 5px; width: 20px; height: 20px; color: white;" class="count bg-danger" id="noti_number"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('all.seller') }}">{{ __('Sellers') }}</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>

<script type="text/javascript">
    function loadDoc() {
        setInterval(function(){
            $('#noti_number').load('/{{ config('app.name', 'Laravel') }}/public/noti_number.php');
      },1000);
    }
    loadDoc();
</script>