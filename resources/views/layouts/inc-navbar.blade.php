<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <?php
    $route = Route::currentRouteName();
    ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">@lang('web.home')<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">@lang('web.product')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'signup') active @endif" href="{{ route('signup') }}">@lang('web.signup')</a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if($route == 'contactus') active @endif" href="{{ route('contactus') }}">@lang('web.contactus')</a>
            </li>
        </ul>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - Language -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-globe-asia fa-fw"></i>@lang('web.currentlang')
            </a>
            <!-- Dropdown - Cart Item -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right animated--grow-in" aria-labelledby="languageDropdown">
                <a class="dropdown-item" href="javascript:changeLanguage('th');">
                    TH
                </a>
                <a class="dropdown-item" href="javascript:changeLanguage('en');">
                    EN
                </a>
            </div>
        </li>

        <!-- Nav Item - Cart -->
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="cartDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-shopping-cart fa-fw"></i>
                <!-- Counter - Cart -->
                <span class="badge badge-danger badge-counter" id="numberItemCart"></span>
            </a>
            <!-- Dropdown - Cart Item -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="cartDropdown" id="viewcart">
            </div>
        </li>
    </ul>

</nav>
