@extends('layouts.layout')

@section('content')
    <div id="user-profile-container" class="basic-container">
        <form action="{{route('update.profile')}}" method="POST" onsubmit="return updateUser.validate()" id="update-user" class="user-main-box">
            <h3 id="update-user-title">General information</h3>
            @if (count($errors) > 0)
                <div id="register-error-list" class="form-error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div id="update-user-inputs">
                <div class="label-with-input">
                    <label for="update-username">Username</label>
                    <input type="text" name="update-username" id="update-username" value="{{$user->username}}" placeholder="Update here...">
                    <p id="update-username-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div class="label-with-input">
                    <label for="update-email">Email</label>
                    <input type="email" name="update-email" id="update-email" value="{{$user->email}}" placeholder="Update here...">
                    <p id="update-email-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div class="label-with-input">
                    <label for="update-password">Password</label>
                    <input type="password" name="update-password" id="update-password"  placeholder="Update here...">
                </div>
                <div class="label-with-input">
                    <label for="update-location">Location</label>
                    <input type="text" name="update-location" id="update-location" value="{{$user->location}}" placeholder="Update here...">
                    <p id="update-location-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div class="label-with-input">
                    <label for="update-signature">Signature</label>
                    <input type="text" name="update-signature" id="update-signature" value="{{$user->signature}}" placeholder="Update here...">
                    <p id="update-signature-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
            </div>
            <button id="update-user-save" class="main-color-button">Save</button>
            @csrf
        </form>
        <div id="user-summary">
            <div id="user-summary-background">
                <img src="{{asset("assets/img/".$user->avatar)}}" id="user-profile-avatar">
            </div>
            <div id="user-summary-info">
                <form action="{{route('update.avatar')}}" method="POST" enctype="multipart/form-data" id="us-form">
                    <label for="us-change-avatar" id="us-change-avatar-label">Change image <i class="fa-solid fa-camera"></i></label>
                    <input type="file" id="us-change-avatar" name="update-avatar">
                    @csrf
                </form>
                <p id="us-username" class="user-highlight">{{$user->username}}</p>
                <p id="us-email">{{$user->email}}</p>
                <p id="us-location">Location: @if($user->location)<span>Belgrade, Serbia</span>@else<span style="font-style: italic;">Not specified</span>@endif</p>
            </div>
        </div>
    </div>
@endsection
