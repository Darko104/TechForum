@extends('layouts.layout')

@section('content')

    @include('partials.greeting')
    <div class="forum-categories">
        @foreach($categories as $categoryTopics)
            <div class="basic-container forum-category">
                <div class="category-header">
                    <p class="category-name">{{$categoryTopics->category->name}}</p>
                    <p class="info-title">threads</p>
                    <p class="info-title">posts</p>
                    <p class="info-title category-last">last thread</p>
                </div>
                @foreach($categoryTopics->topics as $topic)
                    <div class="topic-info-wrapper">
                        <div class="topic-info">
                            <div class="topic-preview">
                                <p class="topic-name"><a href="{{$topic->link}}">{{$topic->mainTopic->name}}</a></p>
                                @if(count($topic->subTopics) != 0)
                                    <div class="topic-subcategories-wrapper">
                                        <p class="topic-subcategories-direction">Subcategories:</p>
                                        <div class="topic-subcategories-row">
                                            @foreach($topic->subTopics as $subTopic)
                                                <p class="subcategory-bubble"><a href="topic/{{$subTopic->id}}">{{$subTopic->name}}</a></p>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="topic-threads">{{$topic->countThreads}}</div>
                            <div class="topic-posts">{{$topic->countPosts}}</div>
                            <div class="topic-latest">
                                @if($topic->lastThread)
                                <div class="topic-latest-avatar">
                                    <img src="{{asset('assets/img/'.$topic->lastThread->avatar)}}" class="tlt-avatar">
                                </div>
                                <div class="topic-latest-thread">
                                        <p class="tlt-name">{{$topic->lastThread->shortenedTitle}}</p>
                                        <p class="tlt-username">By: <span>{{$topic->lastThread->username}}</span></p>
                                        <p class="tlt-date">{{date('D M d, Y H:i', strtotime($topic->lastThread->creationDate))}}</p>
                                </div>
                                @else
                                <div class="topic-latest-thread">
                                    <p class="tlt-date">No threads</p>
                                </div>
                                @endif
                            </div>

                            @if(Session::get('user') && Session::get('user')->user_privilege_id == 2)
                                <div class="admin-options topic-admin-options">
                                    <button class="admin-option-button admin-delete"><a href="/topic/remove/{{$topic->mainTopic->id}}">Delete</a></button>
                                    <button class="admin-option-button admin-edit"><a href="/topic/edit/{{$topic->mainTopic->id}}">Edit</a></button>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <div id="index-info">
        @include('partials.user_statistics')
    </div>

@endsection
