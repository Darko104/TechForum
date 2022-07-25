@extends('layouts.layout')

@section('content')
    <div id="user-notifications" class="basic-container">
        <p id="user-title">Notifications</p>
        <div id="notifications-wrapper">
            @foreach($notifications as $notif)
                <div class="single-notification">
                    <div class="not-avat-wrapper">
                        <img src="{{asset('assets/img/'.$notif->avatar)}}" class="not-avat">
                    </div>
                    <div class="not-content">
                        <div class="not-header">
                            <p class="not-header-user">{{$notif->username}}</p>
                            <p class="not-header-action">{{$notif->text}}</p>
                        </div>
                        <div class="not-message">
                            <p class="not-content-desc">{{$notif->content}}</p>
                            <p class="not-date">{{$notif->notificationCreation}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
