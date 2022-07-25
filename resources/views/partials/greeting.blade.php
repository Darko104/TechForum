<div id="greeting-message">

    @if(Session::get('user'))
        <h2>Welcome, {{Session::get('user')->username}}</h2>
        <p>Enjoy your stay.</p>
    @else
        <h2>Welcome to TechForums</h2>
        <p>Welcome to our forum, enjoy your stay.</p>
        <div id="greeting-message-action">
            <button type="button" class="light-button"><a href="{{route('login.show')}}">Login</a></button>
            <button type="button" class="light-button"><a href="{{route('register.show')}}">Register</a></button>
        </div>
    @endif
</div>
