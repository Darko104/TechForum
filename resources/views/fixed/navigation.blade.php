<nav>
    <p id="nav-logo"><a href="{{route('home')}}">TechForum</a></p>
    <form action="{{ route("searchresults") }}" method="GET" id="nav-search">
        <div id="nav-search-initial">
            <p id="nav-search-icon"><i class="fa-solid fa-magnifying-glass"></i></p>
            <input type="text" name="keyword" id="nav-search-input" placeholder="Search...">
        </div>
        <ul id="nav-search-results">
{{--            <li><a href="#">1123</a></li>--}}
{{--            <li><a href="#">1123</a></li>--}}
{{--            <li><a href="#">1123</a></li>--}}
        </ul>
    </form>
    <div id="nav-icons">
        @if(Session::get('user'))
            <a href="{{route('profile.notifications')}}"><i class="fa-solid fa-bell"></i></a>
            <a href="{{route('profile')}}"><img src="{{asset('assets/img/'.Session::get('user')->avatar)}}" id="navigation-avatar"></a>
        @else
            <a href="{{route('login.show')}}"><i class="fa-solid fa-power-off"></i></a>
        @endif
    </div>
</nav>
