<nav class="navbar navbar-expand-md navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Waste-AID') }} <span>&#128465</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">DashBoard <span class="sr-only">(current)</span></a>
                </li>                
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Franchise<span class="sr-only">(current)</span></a>
                        <div class="dropdown-menu"> 
                                <a class="dropdown-item" href="">Profile<span class="sr-only">(current)</span></a>   
                                <a class="dropdown-item" href="">Missed Locations<span class="sr-only">(current)</span></a>                    
                                

                        </div>
                </li>
                <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Requests <span class="sr-only">(current)</span></a>
                        <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="">View Requests<span class="sr-only">(current)</span></a>                            <!---<a class="dropdown-item" href="{{ url('franchiseFirm')}}">Add Franchise Firm<span class="sr-only">(current)</span></a>---->
                                <a class="dropdown-item" href="">Accepted Requests<span class="sr-only">(current)</span></a>
                        </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Notices <span class="sr-only">(current)</span></a>
                    <div class="dropdown-menu">                       
                            <a class="dropdown-item" href="">Your Posts<span class="sr-only">(current)</span></a>                            <!---<a class="dropdown-item" href="{{ url('franchiseFirm')}}">Add Franchise Firm<span class="sr-only">(current)</span></a>---->
                            <a class="dropdown-item" href="">Admin Posts<span class="sr-only">(current)</span></a>
                            <a class="dropdown-item" href="">Create Post<span class="sr-only">(current)</span></a>
                    </div>
                </li>
               
                <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Mail <span class="sr-only">(current)</span></a>
                     <div class="dropdown-menu">   
                        <!--<a class="dropdown-item" href="">Compose Email<span class="sr-only">(current)</span></a>-->
                        <a class="dropdown-item" href="">Direct Message<span class="sr-only">(current)</span></a>
                    </div> 
                </li>
                
            </ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
               <!--- @if(Auth::guard('web')->check())
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('web')->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{route('home')}}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif---->
                @if(Auth::guard('franchise')->check())
                    <li class="nav-item dropdown">
                        <a id="councilDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::guard('franchise')->user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="councilDropdown">
                            <a href="{{ url('/') }}" class="dropdown-item">Dashboard</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();document.querySelector('#council-logout-form').submit();">
                                Logout
                            </a>
                            <form id="council-logout-form" action="{{ route('franchise.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> 