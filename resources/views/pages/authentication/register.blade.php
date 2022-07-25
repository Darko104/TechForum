@extends('layouts.layout')

@section('content')
    <div class="basic-container divided-container">
        <div id="register-left">
            <h1 class="dc-title">Register</h1>
            <form action="{{route('register.doRegister')}}" method="POST" id="register-form" onsubmit="return register.validate()">
                @if (count($errors) > 0)
                    <div id="register-error-list" class="form-error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="register-form-inputs" class="authentication-form-inputs">
                    <div class="label-input">
                        <label for="register-username">Username</label>
                        <input type="text" name="register-username" id="register-username" placeholder="Type here...">
                        <p id="register-username-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                    <div class="label-input">
                        <label for="register-email">Email</label>
                        <input type="email" name="register-email" id="register-email" placeholder="Type here...">
                        <p id="register-email-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                    <div class="label-input">
                        <label for="register-password">Password</label>
                        <input type="password" name="register-password" id="register-password" placeholder="Type here...">
                        <p id="register-password-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                    <div class="label-input">
                        <label for="register-confirm-password">Confirm password</label>
                        <input type="password" name="register-confirm-password" id="register-confirm-password" placeholder="Type here...">
                        <p id="register-confirm-password-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                    </div>
                </div>
                <button id="finish-registration" class="main-color-button finish-action-auth-button">Sign up</button>
                <div id="register-existing-member">
                    <p>Already a member?</p>
                    <p>Go to <a href="{{route('login.show')}}">Sign In</a></p>
                </div>
                @csrf
            </form>
        </div>
        <div id="message-rules-wrapper">
            <h1 class="dc-title">Rules</h1>
            <div id="message-rules">
                <div class="message-rule">
                    <p class="message-rule-title">Username</p>
                    <p class="message-rule-desc">Username is required, only alpha-numeric characters, as well as dashes and underscores are allowed. Minimum length is 2, and maximum is 30.
                    </p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Email</p>
                    <p class="message-rule-desc">Email is required. Needs to follow a reqular email structure. Example: user@gmail.com</p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Password</p>
                    <p class="message-rule-desc">Password must contain minimum 5 characters, with at least one number and one letter. 'Password' and 'Confirm Password' fields must be equal.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
