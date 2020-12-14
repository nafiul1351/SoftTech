<nav class="navbar navbar-light col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div style="position: relative;" class="text-center navbar-brand-wrapper">
        <a class="navbar-brand brand-logo" href="{{ URL::to('/') }}"><img style="position: absolute; width: 80%; height: 80%; top: 10%; left: 10%;" src="{{ asset('public/images/icon/logo.svg') }}" alt="Logo"></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-lg-auto">
            <li class="nav-item dropdown">
                <a class="nav-link count-indicator" id="MailDropdown" href="#" data-toggle="dropdown">
                    <img src="{{asset('public/images/stngs.png')}}" alt="">
                </a>
                <div class="dropdown-menu navbar-dropdown mail-notification" aria-labelledby="MailDropdown">
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="sender-img">
                            <img src="{{asset('public/images/lo.jpg')}}" alt="">
                        </div>
                        <div class="sender">
                            <p class="Sende-name">{{ __('Logout') }}</p>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>