@extends('layouts.layout')

@section('content')

    @include('partials.greeting')
    <div class="forum-categories">
        <div class="basic-container forum-category">
            <div class="category-header">
                <p class="category-name">{{$mainTopic->name}} - Subtopics</p>
                <p class="info-title">threads</p>
                <p class="info-title">posts</p>
                <p class="info-title category-last">last post</p>
            </div>
            @foreach($subtopicsandcounter as $subtopic)
                <div class="topic-info">
                    <div class="topic-preview">
                        <p class="topic-name"><a href="{{$subtopic->link}}">{{$subtopic->general->name}}</a></p>
                    </div>
                    <div class="topic-threads">{{$subtopic->countThreads}}</div>
                    <div class="topic-posts">{{$subtopic->countPosts}}</div>
                    <div class="topic-latest">
                        @if($subtopic->lastThread)
                            <div class="topic-latest-avatar">
                                <img src="{{asset('assets/img/'.$subtopic->lastThread->avatar)}}" class="tlt-avatar">
                            </div>
                            <div class="topic-latest-thread">
                                <p class="tlt-name">{{$subtopic->lastThread->shortenedTitle}}</p>
                                <p class="tlt-username">By: <span>{{$subtopic->lastThread->username}}</span></p>
                                <p class="tlt-date">{{date('D M d, Y H:i', strtotime($subtopic->lastThread->creationDate))}}</p>
                            </div>
                        @else
                            <div class="topic-latest-thread">
                                <p class="tlt-date">No threads</p>
                            </div>
                        @endif
                    </div>

                    @if(Session::get('user') && Session::get('user')->user_privilege_id == 2)
                        <div class="admin-options topic-admin-options">
                            <button class="admin-option-button admin-delete"><a href="/topic/remove/{{$subtopic->general->id}}">Delete</a></button>
                            <button class="admin-option-button admin-edit"><a href="/topic/edit/{{$subtopic->general->id}}">Edit</a></button>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

@endsection
