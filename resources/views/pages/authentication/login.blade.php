@extends('layouts.layout')

@section('content')
    <div id="login-container" class="basic-container divided-container">
        <div id="login-left">
            <h1 class="dc-title">Sign In</h1>
            <form action="{{route('login.doLogin')}}" method="POST" id="login-form" class="authentication-form" onsubmit="return login.validate()">
                @if(Session::get('successfullRegistration'))
                    <div class="info-container">
                        <p>{{Session::get('successfullRegistration')}}</p>
                    </div>
                    {{Session::forget('successfullRegistration')}}
                @endif
                @if (count($errors) > 0)
                    <div id="register-error-list" class="form-error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="login-form-inputs" class="authentication-form-inputs">
                    <div class="label-input">
                        <label for="login-password">Email</label>
                        <input type="email" name="login-email" id="login-email" placeholder="Type here...">
                        <p id="login-email-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                    <div class="label-input">
                        <label for="login-password">Password</label>
                        <input type="password" name="login-password" id="login-password" placeholder="Type here...">
                        <p id="login-password-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                </div>
                <button type="submit" class="main-color-button finish-action-auth-button">Sign up</button>
                @csrf
            </form>
        </div>
        <div id="login-right">
            <h1 class="dc-title">New member?</h1>
            <p id="sign-in-type-desc">Creating an account has many benefits: customize your account, interact with other people and more...</p>
            <button class="main-color-button"><a href="{{route('register.show')}}">Create an account</a></button>
        </div>
    </div>
@endsection
