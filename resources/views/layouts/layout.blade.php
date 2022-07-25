<!DOCTYPE html>
<html lang="en">

@include('fixed.head')

<body>

<section id="full-page-grid">

    {{--  Navigation and main content  --}}
    <div id="left-side">
        @include('fixed.navigation')
        <main id="forum-preview">
            @include('partials.page_location_time')
            @yield('content')
        </main>
        @include('fixed.footer')
    </div>

    {{--  Sidebar  --}}
    @include('fixed.sidebar')
</section>

@include('fixed.scripts')
</body>
</html>
