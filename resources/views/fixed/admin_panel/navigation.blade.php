<nav class="navbar navbar-expand navbar-light navbar-bg">
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown"><span class="text-dark">{{Session::get('user')->username}}</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
