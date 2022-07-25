<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{route('home')}}"><span class="align-middle">TechForum</span></a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item @if($currentPage == 'main') active @endif">
                <a class="sidebar-link" href="{{route('panel.main')}}">
                    <i class="fa-solid fa-sliders"></i> <span class="align-middle">Main</span>
                </a>
            </li>

            <li class="sidebar-item @if($currentPage == 'topics') active @endif">
                <a class="sidebar-link" href="{{route('panel.topics')}}">
                    <i class="fa-solid fa-comment"></i> <span class="align-middle">Topics</span>
                </a>
            </li>

            <li class="sidebar-item @if($currentPage == 'threads') active @endif">
                <a class="sidebar-link" href="{{route('panel.threads')}}">
                    <i class="fa-solid fa-file"></i> <span class="align-middle">Threads</span>
                </a>
            </li>

            <li class="sidebar-header">
                Account
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('login.logoff')}}">
                    <i class="fa-solid fa-user"></i> <span class="align-middle">Profile</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="pages-sign-up.html">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> <span class="align-middle">Log off</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
