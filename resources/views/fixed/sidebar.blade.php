<aside id="user-sidebar">
    @if(Session::get('user'))
        <div id="sidebar-title">
            <p class="header-title">Profile</p>
        </div>
        <div class="sidebar-links">
            @if(Session::get('user')->user_privilege_id == 2)
                <div class="sidebar-link">
                    <a href="{{route('panel.main')}}">
                        <i class="fa-solid fa-terminal"></i>
                        <p>Panel</p>
                    </a>
                </div>
            @endif
            <div class="sidebar-link">
                <a href="{{route('profile')}}">
                    <i class="fa-solid fa-user"></i>
                    <p>Profile</p>
                </a>
            </div>
            <div class="sidebar-link">
                <a href="{{route('login.logoff')}}">
                    <i class="fa-solid fa-power-off"></i>
                    <p>Logout</p>
                </a>
            </div>
        </div>
        <div class="sidebar-links">
            <div class="sidebar-link">
                <a href="{{route('profile.posts')}}">
                    <i class="fa-solid fa-message"></i>
                    <p>Your posts</p>
                </a>
            </div>
            <div class="sidebar-link">
                <a href="{{route('profile.notifications')}}">
                    <i class="fa-solid fa-bell"></i>
                    <p>Notifications</p>
                </a>
            </div>
        </div>
    @else
        <div id="sidebar-upper">
            <div id="login-register-action">
                <p class="lr-action header-title"><a href="{{route('login.show')}}">login</a></p>
                <div id="small-circle"></div>
                <p class="lr-action header-title"><a href="{{route('register.show')}}">register</a></p>
            </div>
            <form action="{{route('login.doLogin')}}" method="POST" id="aside-sign-in">
                <div id="register-error-list" class="form-error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                        @endforeach
                    </ul>
                </div>
                <div class="aside-inputs">
                    <input type="email" name="login-email" class="aside-input" placeholder="Email">
                    <input type="password" name="login-password" class="aside-input" placeholder="Password">
                </div>
                <button type="submit" id="aside-input-submit" class="light-button">Login</button>
                <p id="aside-regsiter-call"><a href="{{route('register.show')}}">Register</a></p>
                @csrf
            </form>
        </div>
    @endif

    <div id="sidebar-icons">
        <i class="fa-brands fa-facebook-square"></i>
        <i class="fa-brands fa-instagram-square"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-youtube"></i>
    </div>
</aside>
