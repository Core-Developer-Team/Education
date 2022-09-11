<nav class="navbar navbar-expand-lg bg-micko micko-head justify-content-sm-start micko-top pt-0 pb-0 px-2 px-lg-4">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="micko-toggler-icon">
                <i class="feather-menu"></i>
            </span>
        </button>
        <a class="navbar-bran ms-lg-0 ml-2 me-auto" href="{{route('req.index')}}">

            <div class="res_main_logo">
                <img src="{{asset('images/res-logo.png')}}" alt="">
            </div>
            <div class="main_logo" id="logo">
                <img src="{{asset('images/logo.png')}}" alt="">
                <img class="logo-inverse" src="{{asset('images/dark-logo.png')}}" alt="">
            </div>
        </a>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <div class="offcanvas-logo" id="offcanvasNavbarLabel">
                    <img src="{{asset('images/res-logo.png')}}" alt="">
                </div>
                <button type="button" class="close-btn btn-color" data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="feather-x"></i>
                </button>
            </div>
            <div class="offcanvas-body">
                <!-- <div class="offcanvas-search">
<form class="search-form-header">
<input class="search-form-control" type="search" placeholder="Search..." aria-label="Search">
<button class="search-btn btn-color btn-hover"><i class="feather-search"></i></button>
</form>
</div> -->
                <ul class="navbar-nav justify-content-end flex-grow-1 pe_5">
                    @auth
                    @if (Auth::user()->role->name == 'Admin')
                    <li class="nav-item">
                        <a class="nav-link {{  (request()->routeIs('admin.index')) ? 'active' : '' }}"
                            aria-current="page" href="{{route('admin.index')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-home"></i>
                            </span>
                            Admin
                        </a>
                    </li>
                    @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link {{  (request()->routeIs('req.index')) ? 'active' : ''  }}"
                            aria-current="page" href="{{route('req.index')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-home"></i>
                            </span>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{  (request()->routeIs('tutorial.getvideos')) ? 'active' : ''  }}"
                            href="{{route('tutorial.getvideos')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-briefcase"></i>
                            </span>
                            Tutorial
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{  (request()->routeIs('books.index')) ? 'active' : ''  }}"
                            href="{{route('market.index')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-shopping-cart"></i>
                            </span>
                            Marketplace
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{  (request()->routeIs('course.index')) ? 'active' : ''  }}"
                            href="{{route('course.index')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-book-open"></i>
                            </span>
                            Learning
                        </a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-book-open"></i>
                            </span>
                            Login
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">
                            <span class="nav-icon d-lg-none">
                                <i class="feather-book-open"></i>
                            </span>
                            Register
                        </a>
                    </li>
                    @endif
                    @endguest
                </ul>
            </div>
            <div class="offcanvas-footer">
                <div class="micko-copyright">
                    <p><i class="fas fa-copyright"></i>2022 Micko by <a href="#">Gambolthemes</a>. All Right
                        Reserved.</p>
                </div>
            </div>
        </div>
        <div class="msg-noti-acnt-section order-2">
            <ul class="mn-icons-set ms-3 align-self-stretch">

                @auth
                <li class="mn-icon">
                    <a class="mn-link" href="{{route('messages')}}" role="button">
                        <i class="feather-message-square"></i>
                        <div class="alert-circle"></div>
                    </a>
                </li>
                <li class="mn-icon">
                    <a class="mn-link" href="all_notifications.html" role="button">
                        <i class="feather-bell"></i>
                        <div class="alert-circle"></div>
                    </a>
                </li>
                <li class="mn-icon dropdown dropdown-account ms-4">
                    <a href="#" class="opts_account" role="button" id="dropdownMenuClickableInside"
                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                        <img src="/storage/{{Auth()->user()->image}}" alt="">
                        <i class="fas fa-caret-down arrow-icon"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-account dropdown-menu-end"
                        aria-labelledby="dropdownMenuClickableInside">
                        <li class="media-list">
                            <div class="night_mode_switch__btn">
                                <a href="#" id="night-mode" class="btn-night-mode">
                                    <i class="far fa-moon"></i>Night mode
                                    <span class="btn-night-mode-switch">
                                        <span class="uk-switch-button"></span>
                                    </span>
                                </a>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer">
                            <a href="{{ route('profile.show', ['id'=>Auth()->id()]) }}" id="night-mode"
                                class="dropdown-item-link text-link text-center" title="{{auth()->user()->username}}">
                                Profile
                            </a>
                        </li>
                        <li class="dropdown-menu-footer">
                            <a href="{{ route('profile.index') }}" id="night-mode"
                                class="dropdown-item-link text-link text-center">
                                Setting
                            </a>
                        </li>
                        <li class="dropdown-menu-footer">
                            <a href="{{ route('badge.show') }}" id="night-mode"
                                class="dropdown-item-link text-link text-center">
                                Badges
                            </a>
                        </li>
                        <li class="dropdown-menu-footer">
                            <form action="{{route('logout')}}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item-link text-link text-center">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
