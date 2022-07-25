<!DOCTYPE html>
<html lang="en">

@include('fixed.admin_panel.head')

<body>
    <div class="wrapper">
        @include('fixed.admin_panel.sidebar')

        <div class="main">
            @include('fixed.admin_panel.navigation')

            <main class="content">
                @yield('content')
            </main>

            @include('fixed.admin_panel.footer')
        </div>
    </div>

@include('fixed.scripts')
</body>
</html>
