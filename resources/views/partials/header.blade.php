<!-- Top header start -->
<header class="top-header th-bg" id="top-header-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-7">
                <div class="list-inline">
                    <a href="tel:+256778162705"><i class="fa fa-phone"></i>+256 778162705</a>
                    <a href="mailto:info@ojjorealestate.com"><i class="fa fa-envelope"></i>info@ojjorealestate.com</a>
                    <a href="#" class="mr-0 d-none-992"><i class="fa fa-clock-o"></i>Mon - Sun: 8:00am - 6:00pm</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-5">
                <ul class="top-social-media pull-right">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="sign-in"><i class="fa fa-sign-in"></i> Login </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="sign-in"><i class="fa fa-user"></i> Register</a>
                        </li>
                    @endguest
                    
                    @auth
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle user-avatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user-circle"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @if(Auth::user()->hasRole('admin'))
                                    <li><a class="dropdown-item" href="{{ route('filament.admin.pages.dashboard') }}"><i class="fa fa-dashboard"></i> Admin Dashboard</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="fa fa-user"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('dashboard.profile') }}"><i class="fa fa-user-o"></i> Profile</a></li>
                                @can('submit property')
                                    <li><a class="dropdown-item" href="{{ route('dashboard.properties.submit') }}"><i class="fa fa-plus"></i> Submit Property</a></li>
                                @endcan
                                <li><a class="dropdown-item" href="{{ route('dashboard.properties.favorite') }}"><i class="fa fa-heart"></i> Favorite Properties</a></li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Top header end -->

<!-- main header start -->
<header class="main-header sticky-header" id="main-header-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light rounded">
                    <a class="navbar-brand logo" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logos/black-logo.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" id="drawer">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav justify-content-end ml-auto">
                            <li class="nav-item dropdown active">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Index
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a class="dropdown-item" href="index.html">Index 1</a></li>
                                    <li><a class="dropdown-item" href="index-2.html">Index 2</a></li>
                                    <li><a class="dropdown-item" href="index-3.html">Index 3</a></li>
                                    <li><a class="dropdown-item" href="index-4.html">Index 4</a></li>
                                    <li><a class="dropdown-item" href="index-5.html">Index 5</a></li>
                                    <li><a class="dropdown-item" href="index-6.html">Index 6</a></li>
                                    <li><a class="dropdown-item" href="index-7.html">Index 7</a></li>
                                    <li><a class="dropdown-item" href="index-8.html">Index 8 (Map)</a></li>
                                    <li><a class="dropdown-item" href="index-9.html">Index 9 (Video)</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Properties
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">List Layout</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="properties-list-rightside.html">Right Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-list-leftside.html">Left Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-list-fullwidth.html">Fullwidth</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Grid Layout</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="properties-grid-rightside.html">Right Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-grid-leftside.html">Left Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-grid-fullwidth.html">Fullwidth</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Map View</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="properties-map-rightside-list.html">Map List Right Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-map-leftside-list.html">Map List Left Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-map-rightside-grid.html">Map Grid Right Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-map-leftside-grid.html">Map Grid Left Sidebar</a></li>
                                            <li><a class="dropdown-item" href="properties-map-full.html">Map FullWidth</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Property Detail</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="properties-details.html">Property Detail 1</a></li>
                                            <li><a class="dropdown-item" href="properties-details-2.html">Property Detail 2</a></li>
                                            <li><a class="dropdown-item" href="properties-details-3.html">Property Detail 3</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pages
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">My Account</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="user-profile.html">User profile</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="my-properties.html">My Properties</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="favorited-properties.html">Favorited Properties</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="submit-property.html">Submit Property</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Services</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="services.html">Services 1</a></li>
                                            <li><a class="dropdown-item" href="services-2.html">Services 2</a></li>
                                            <li><a class="dropdown-item" href="services-details.html">Services Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Pricing Tables</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="pricing-tables-1.html">Pricing Tables 1</a></li>
                                            <li><a class="dropdown-item" href="pricing-tables-2.html">Pricing Tables 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Gallery</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="gallery-1.html">Gallery 1</a></li>
                                            <li><a class="dropdown-item" href="gallery-2.html">Gallery 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Faq</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="faq-1.html">Faq 1</a></li>
                                            <li><a class="dropdown-item" href="faq-2.html">Faq 2</a></li>
                                        </ul>
                                    </li>

                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Typography</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="typography.html">Typography 1</a></li>
                                            <li><a class="dropdown-item" href="typography-2.html">Typography 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">404 Error</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="pages-404.html">404 Error 1</a></li>
                                            <li><a class="dropdown-item" href="pages-404-2.html">404 Error 2</a></li>
                                        </ul>
                                    </li>

                                    <li><a class="dropdown-item" href="properties-comparison.html">Properties Comparison</a></li>
                                    <li><a class="dropdown-item" href="search-brand.html">Search Brand</a></li>
                                    <li><a class="dropdown-item" href="elements.html">Elements</a></li>
                                    <li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a></li>
                                    @guest
                                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login/Register</a></li>
                                    @endguest
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Agents
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Agent List</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="agent-list.html">Agent List 1</a></li>
                                            <li><a class="dropdown-item" href="agent-list-2.html">Agent List 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu"><a class="dropdown-item dropdown-toggle" href="#">Agent Grid</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="agent-grid.html">Agent Grid 1</a></li>
                                            <li><a class="dropdown-item" href="agent-grid-2.html">Agent Grid 2</a></li>
                                            <li><a class="dropdown-item" href="agent-grid-3.html">Agent Grid 3</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" href="agent-detail.html">Agent Detail</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Shop
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                    <a class="dropdown-item" href="shop-cart.html">Shop Cart</a>
                                    <a class="dropdown-item" href="shop-checkout.html">Shop Checkout</a>
                                    <a class="dropdown-item" href="shop-single.html">Shop Details</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact.show') }}">Contact Us</a>
                            </li>
                            <li class="nav-item sb2">
                                <a href="{{ route('dashboard.properties.submit') }}" class="submit-btn">
                                    Submit Property
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- main header end -->

<!-- Sidenav start -->
<nav id="sidebar" class="nav-sidebar">
    <!-- Close btn-->
    <div id="dismiss">
        <i class="fa fa-close"></i>
    </div>
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <img src="{{ asset('assets/img/logos/black-logo.png') }}" alt="sidebarlogo">
        </div>
        <div class="sidebar-navigation">
            <h3 class="heading">Pages</h3>
            <ul class="menu-list">
                @auth
                    <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ route('dashboard.properties.my') }}"><i class="fa fa-building"></i> My Properties</a></li>
                    <li><a href="{{ route('dashboard.profile') }}"><i class="fa fa-user"></i> Profile</a></li>
                    <li><a href="{{ route('dashboard.properties.submit') }}"><i class="fa fa-plus"></i> Submit Property</a></li>
                    @hasrole('admin')
                        <li><a href="{{ route('filament.admin.pages.dashboard') }}" target="_blank"><i class="fa fa-cog"></i> Admin Panel</a></li>
                    @endhasrole
                @endauth
                
                <li><a href="#" class="active pt0">Index <em class="fa fa-chevron-down"></em></a>
                    <ul>
                        <li><a href="{{ route('home') }}">Index 1</a></li>
                        <li><a href="index-2.html">Index 2</a></li>
                        <li><a href="index-3.html">Index 3</a></li>
                        <li><a href="index-4.html">Index 4</a></li>
                        <li><a href="index-5.html">Index 5</a></li>
                        <li><a href="index-6.html">Index 6</a></li>
                        <li><a href="index-7.html">Index 7</a></li>
                        <li><a href="index-8.html">Index 8</a></li>
                        <li><a href="index-9.html">Index 9</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Properties <em class="fa fa-chevron-down"></em></a>
                    <ul>
                        <li>
                            <a href="#">List Layout <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="properties-list-rightside.html">Right Sidebar</a></li>
                                <li><a href="properties-list-leftside.html">Left Sidebar</a></li>
                                <li><a href="properties-list-fullwidth.html">Fullwidth</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Grid Layout <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="properties-grid-rightside.html">Right Sidebar</a></li>
                                <li><a href="properties-grid-leftside.html">Left Sidebar</a></li>
                                <li><a href="properties-grid-fullwidth.html">Fullwidth</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Map View <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="properties-map-rightside-list.html">Map List Right Sidebar</a></li>
                                <li><a href="properties-map-leftside-list.html">Map List Left Sidebar</a></li>
                                <li><a href="properties-map-rightside-grid.html">Map Grid Right Sidebar</a></li>
                                <li><a href="properties-map-leftside-grid.html">Map Grid Left Sidebar</a></li>
                                <li><a href="properties-map-full.html">Map FullWidth</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Property Detail <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="properties-details.html">Property Detail 1</a></li>
                                <li><a href="properties-details-2.html">Property Detail 2</a></li>
                                <li><a href="properties-details-3.html">Property Detail 3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#">Pages <em class="fa fa-chevron-down"></em></a>
                    <ul>
                        <li>
                            <a href="#">My Account <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="user-profile.html">User profile</a></li>
                                <li><a href="my-properties.html">My Properties</a></li>
                                <li><a href="favorited-properties.html">Favorited Properties</a></li>
                                <li><a href="submit-property.html">Submit Property</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Services <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="services.html">Services 1</a></li>
                                <li><a href="services-2.html">Services 2</a></li>
                                <li><a href="services-details.html">Services Details</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Pricing Tables <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="pricing-tables-1.html">Pricing Tables 1</a></li>
                                <li><a href="pricing-tables-2.html">Pricing Tables 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Gallery <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="gallery-1.html">Gallery 1</a></li>
                                <li><a href="gallery-2.html">Gallery 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Faq <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="faq-1.html">Faq 1</a></li>
                                <li><a href="faq-2.html">Faq 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Typography <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="typography.html">Typography 1</a></li>
                                <li><a href="typography-2.html">Typography 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">404 Error <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="pages-404.html">404 Error 1</a></li>
                                <li><a href="pages-404-2.html">404 Error 2</a></li>
                            </ul>
                        </li>
                        <li><a href="properties-comparison.html">Properties Comparison</a></li>
                        <li><a href="search-brand.html">Search Brand</a></li>
                        <li><a href="elements.html">Elements</a></li>
                        <li><a href="coming-soon.html">Coming Soon</a></li>
                        @guest
                            <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login/Register</a></li>
                        @endguest
                    </ul>
                </li>
                <li>
                    <a href="#"> Agents <em class="fa fa-chevron-down"></em></a>
                    <ul>
                        <li>
                            <a href="#">Agent List <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="agent-list.html">Agent List 1</a></li>
                                <li><a href="agent-list-2.html">Agent List 2</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">Agent Grid <em class="fa fa-chevron-down"></em></a>
                            <ul>
                                <li><a href="agent-grid.html">Agent Grid 1</a></li>
                                <li><a href="agent-grid-2.html">Agent Grid 2</a></li>
                                <li><a href="agent-grid-3.html">Agent Grid 3</a></li>
                            </ul>
                        </li>
                        <li><a href="agent-detail.html">Agent Detail</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="#">Shop <em class="fa fa-chevron-down"></em></a>
                    <ul>
                        <li><a class="dropdown-item" href="shop-list.html">Shop List</a></li>
                        <li><a class="dropdown-item" href="shop-cart.html">Shop Cart</a></li>
                        <li> <a class="dropdown-item" href="shop-checkout.html">Shop Checkout</a></li>
                        <li><a class="dropdown-item" href="shop-single.html">Shop Details</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('about-us') }}">About Us</a></li>
                <li><a href="{{ route('contact.show') }}">Contact Us</a></li>
                
                <li>
                    <a href="#">Submit Property</a>
                </li>
                
                @guest
                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                    <li><a href="{{ route('register') }}"><i class="fa fa-user-plus"></i> Register</a></li>
                @endguest
                
                @auth
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </a>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
        <div class="get-in-touch">
            <h3 class="heading">Get in Touch</h3>
            <div class="media">
                <i class="fa fa-phone"></i>
                <div class="media-body">
                    <a href="tel:+256778162705">+256 778162705</a>
                </div>
            </div>
            <div class="media">
                <i class="fa fa-envelope"></i>
                <div class="media-body">
                    <a href="mailto:info@ojjorealestate.com">info@ojjorealestate.com</a>
                </div>
            </div>
            <div class="media mb-0">
                <i class="fa fa-fax"></i>
                <div class="media-body">
                    <a href="mailto:info@ojjorealestate.com">info@ojjorealestate.com</a>
                </div>
            </div>
        </div>
        <div class="get-social">
            <h3 class="heading">Get Social</h3>
            <a href="#" class="facebook-bg">
                <i class="fa fa-facebook"></i>
            </a>
            <a href="#" class="twitter-bg">
                <i class="fa fa-twitter"></i>
            </a>
            <a href="#" class="google-bg">
                <i class="fa fa-google"></i>
            </a>
            <a href="#" class="linkedin-bg">
                <i class="fa fa-linkedin"></i>
            </a>
        </div>
    </div>
</nav>
<!-- Sidenav end -->