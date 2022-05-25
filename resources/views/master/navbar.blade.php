@if (Auth::check() or config('app.public'))
<nav class="navbar navbar-expand-lg  navbar-dark bg-mgray fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route("home") }}"><img loading="lazy" src="{{ config('app.logo')}}" style="width:40px;margin-right:10px;" /><span class="d-none d-lg-inline-block">{{ config('app.name') }}</span></a>

        <input type="checkbox" id="navbar-toggle-cbox">


        <label class="navbar-toggler" for="navbar-toggle-cbox" data-toggle="collapse"
               data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
               aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </label>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto shop-menu">
                <li class="nav-item has-children text-center home" style="position:relative; padding: 0 1.5rem;">
                    <span class="nav-node nav-link w-100">
                        <span class="d-block d-lg-inline-block"><a href="{{ route('home') }}">Home</a></span>
                    </span>
                </li>
                <li class="nav-item has-children text-center shop" style="position:relative; padding: 0 1.5rem;">
                    <span class="nav-node nav-link w-100">
                        <a href="{{ route('index.shop') }}">
                            <span class="d-block d-lg-inline-block">Shop</span>
                        </a>
                    </span>
                    <input class="d-lg-none" type="checkbox" style="position:absolute; right:1em; top:0.5em; z-index:500">
                    <i style="position:absolute; right:1em; top:0.5em" class="fas fa-angle-down d-block d-lg-none"></i>
                    <div class="dropdown-menu" style="top:2.55em; left:-0.05em">
                        <div> @include('includes.search') </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6"> 
                                <h4><a href="{{ route('categories') }}">Categories</a></h4>
                                
                            </div>
                            <div class="col-md-12 col-lg-6"> 
                                <h4><a href="{{ route('vendors') }}">Vendors</a></h4>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item has-children text-center" style="position:relative; padding: 0 1.5rem;">
                    <span class="nav-node nav-link w-100">
                        <span class="d-block d-lg-inline-block"><a href="{{ route('contact') }}">Contact</a></span>
                    </span>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item has-children text-center" style="position:relative; padding: 0 1.5rem;">
                    <span class="nav-node nav-link w-100">
                        <i class="d-none d-lg-inline-block fas fa-money-bill mr-2"></i>
                        <span class="d-block d-lg-none">Change currency</span>
                    </span>
                    <input class="d-lg-none" type="checkbox" style="position:absolute; right:1em; top:0.5em; z-index:500"><i style="position:absolute; right:1em; top:0.5em" class="fas fa-angle-down d-block d-lg-none"></i>
                    @include('includes.currencyquick')
                </li>
        {{-- @auth --}}
            <li class="nav-item text-center @isroute('profile.cart') active @endisroute" style="position:relative; padding: 0 1.5rem;">
                <span class="nav-node nav-link w-100">
                    <a href="{{ route('profile.cart') }}">
                        <i class="d-none d-lg-inline-block fas fa-shopping-cart mr-2"></i>
                        <span class="d-block d-lg-none">Cart ({{ session('cart_items') !== null ? count(session('cart_items')) : 0 }})</span>
                    </a>
                </span>
                <input class="d-lg-none" type="checkbox" style="position:absolute; right:1em; top:0.5em; z-index:100">
                <i style="position:absolute; right:1em; top:0.5em;" class="fas fa-angle-down d-block d-lg-none"></i>
                @include('includes.cart', [ 
                    'items' => \App\Marketplace\Cart::getCart()->items(), 
                    'total' => \App\Marketplace\Cart::getCart()->total()
                ])
            </li>
        {{-- @endauth --}}
        
        @auth
            <li class="nav-item has-children" style="position:relative; padding: 0 1.5rem;">
                <span class="nav-node nav-link w-100 @if(auth()->user()->unreadNotifications()->count() > 0) @endif">
                    <a href="{{ route('profile.index') }}"> 
                        <span class="d-block d-lg-none">Account</span>
                        <span class="d-none d-lg-inline-block"><i class="fa fa-user"></i><!--{{auth()->user()->username}}--></span>
                    </a>
                </span>
                <input class="d-lg-none" type="checkbox" style="position:absolute; right:1em; top:0.5em; z-index:100">
                <i style="position:absolute; right:1em; top:0.5em;" class="fas fa-angle-down d-block d-lg-none"></i>
                <ul class="dropdown-menu" style="top:2.55em; left:-0.05em">
                        <li class="dropdown-item">
                            <a class="nav-link" href="{{ route('profile.index') }}">Profile</a>
                        </li>
                    @admin
                        <li class="dropdown-item @isroute('admin') active @endisroute">
                            <a class="nav-link" href="{{ route('admin.index') }}">Admin panel</a>
                        </li>
                    @endadmin
                    
                    @moderator
                        <li class="dropdown-item @isroute('admin') active @endisroute">
                            <a class="nav-link" href="{{ route('admin.index') }}">Moderator panel</a>
                        </li>
                    @endmoderator
                        
                    
                        <li class="dropdown-item @isroute('profile.notifications') active @endisroute">
                            <a href="{{route('profile.notifications')}}" class="nav-link">
                                Notifications
                            </a>
                        </li>
                        <li class="dropdown-item @isroute('profile.tickets') active @endisroute">
                            <a class="nav-link" href="{{ route('profile.tickets') }}">Support</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item">
                            
                            <form class="form-inline" action="{{route('auth.signout.post')}}" method="post">
                                {{csrf_field()}}
                                <button class="btn btn-link text-muted my-0" type="submit" style="text-decoration: none;">Sign Out</button>
                            </form>
                        </li>
                    
                    </ul>
                </li>
            @else
            <li class="nav-item" style="position:relative; padding: 0 1.5rem;">
                <span class="nav-node nav-link w-100">
                    <a href="{{ route('auth.signin') }}"> 
                        <span class="d-block d-lg-none">Sign in/Sign up</span>
                        <span class="d-none d-lg-inline-block"><i class="fas fa-sign-in-alt"></i></span>
                    </a>
                </span>
            @endauth
            </ul>
        </div>
    </div>
</nav>
@endif
