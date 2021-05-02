<nav class="navbar navbar-expand-md navbar navbar-dark bg-dark ">    <div class="container">
    <a class="navbar-brand" href="{{ url('/home') }}">
        {{ config('app.name', 'Waste-AID') }} <span>&#128465</span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
        <!-- Left Side Of Navbar -->
        <!--<ul class="navbar-nav mr-auto">
            <li><a href="/">Home </a></li>
            <li><a href="/about">About </a></li>
            <li><a href="/services">Services </a></li>
            <li><a href="/posts">Blog </a></li>
        </ul>-->

        <ul class="nav navbar-mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('/home') }}">DashBoard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Franchise <span class="sr-only">(current)</span></a>
                <div class="dropdown-menu">                                              
                    <a class="dropdown-item" href="{{ route('userSubcription.index')}}">Subscription<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="{{ route('userFranchises.index')}}">Franchises<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="{{ route('userZones.index')}}">Select Zone<span class="sr-only">(current)</span></a>
                </div>
            </li>
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Requests <span class="sr-only">(current)</span></a>
                    <div class="dropdown-menu">    
                        
                        <a class="dropdown-item" href="">Make Request<span class="sr-only">(current)</span></a>
                        <!---<a class="dropdown-item" href="">Add Franchise Firm<span class="sr-only">(current)</span></a>---->
                       
                        <a class="dropdown-item" href="">Your Requests<span class="sr-only">(current)</span></a>                       
                  
                        
                        
                    <a class="dropdown-item" href="#"><span class="sr-only">(current)</span></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Notices<span class="sr-only">(current)</span></a>
                    <div class="dropdown-menu">    
                            
                           
                            <a class="dropdown-item" href="">Franchise Posts<span class="sr-only">(current)</span></a>                            <!---<a class="dropdown-item" href="{{ url('franchiseFirm')}}">Add Franchise Firm<span class="sr-only">(current)</span></a>---->
                    <a class="dropdown-item" href="">Admin Posts<span class="sr-only">(current)</span></a>

                    </div>
                </li>
            
            <li class="nav-item dropdown">
                 <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Mail <span class="sr-only">(current)</span></a>
                 <div class="dropdown-menu">   
                    <a class="dropdown-item" href="">Contact Us<span class="sr-only">(current)</span></a>
                    <a class="dropdown-item" href="">Direct Message<span class="sr-only">(current)</span></a>
                </div> 
            </li>
            
        </ul>

        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @if (Auth::guest())
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
                    </a>
                   

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">Edit Account<span class="sr-only">(current)</span></a>
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
