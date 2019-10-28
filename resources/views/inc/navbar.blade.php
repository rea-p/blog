<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" style="color:white">{{ config('app.name', 'Portal') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Left Side Of Navbar -->
        <div class="collapse navbar-collapse" id="navbarCollapse">       
            <ul class="navbar-nav mr-auto" style="" >
                <li class="nav-item ">
                <a class="nav-link" href="/home">Home </a>
                </li>  
                <li class="nav-item ">
                @if(auth()->check())
                    @if(Auth::user()->role==0)
                <a class="nav-link" href="/users">Users </a>
                    @endif
                @endif
                </li>  
                <li class="nav-item dropdownmenu" style="position: relative">
                @if(auth()->check())
                    @if(Auth::user()->role==0)
                     <a id="navbarDropdownMenu" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     Department  <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu " aria-labelledby="navbarDropdownMenu">
                    <a class="dropdown-item" href="/dep">View Departments</a>
                    <a class="dropdown-item" href="/tree">Depatment Management</a>    
                    </div>
                    @endif
                @endif
                </li>  
                <li class="nav-item ">
                    <a class="nav-link " href="/chat">Chat</a>
                </li>
            </ul>
                    <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    <li class="nav-item ">
                    @if(auth()->check())
                        @if(Auth::user()->role==0)
                            <a class="nav-link" href="/users/create">New User</a>
                        @endif
                    @endif
                    </li> 
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                                <img src="{{Auth::user()->photo}}" alt="..." class="img-circle special-img" width="30" class="img-thumbnail"></a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">Update Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>
                        @endguest
                </ul>
        </div>
    </div>
</nav> 



