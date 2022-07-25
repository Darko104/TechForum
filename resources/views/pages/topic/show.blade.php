@extends('layouts.layout')

@section('content')

    @include('partials.greeting')
    <div id="category-title">
        <h3>{{$showCasedTopic->name}}</h3>
    </div>
    <form method="GET" id="topic-form">
    <div id="thread-options">
        <button type="button" id="new-topic"><a href="{{ route('thread.add', ['topicId' => request('topicId')]) }}">new topic <i class="fa-solid fa-pen"></i></a></button>
        <div id="search-topic-wrapper">
            <input type="text" name="keyword" id="search-topic" value="@if(request('keyword')){{request('keyword')}}@endif" placeholder="Search this forum...">
            <i class="fa-solid fa-magnifying-glass" id="search-topic-icon"></i>
        </div>
        <div id="sort-topic-wrapper">
            <p>Sort by:</p>
            <select name="sort" id="sort-topic">
                @foreach($sortOptions as $option)
                    @if ($option->val == request('sort') || (!request('sort') && $option->default_selection == 1))
                        <option value="{{$option->val}}" selected>{{$option->name}}</option>
                    @else
                        <option value="{{$option->val}}">{{$option->name}}</option>
                    @endif
                @endforeach
            </select>
            @if(request('sort_dir') == 'asc')
                <i id="sort-topic-icon" class="fa-solid fa-arrow-up-long transform"></i>
                <input type="hidden" name="sort_dir" id="topics-sort-dir" value="asc">
            @else
                <i id="sort-topic-icon" class="fa-solid fa-arrow-down-long"></i>
                <input type="hidden" name="sort_dir" id="topics-sort-dir" value="desc">
            @endif
        </div>
    </div>
    <div id="forum-categories-options" class="forum-categories">
        <div class="basic-container forum-category">
            <div class="category-header">
                <p class="category-name">{{$showCasedTopic->name}}</p>
                <p class="info-title">replies</p>
                <p class="info-title">views</p>
                <p class="info-title category-last">last post</p>
            </div>
            @foreach($threadsAndReplies as $tr)
                <div class="topic-info">
                    <div class="topic-preview">
                        <p class="topic-name"><a href="{{route('thread', ['threadId' => $tr->thread->threadId])}}">{{$tr->thread->title}}</a></p>
                        <p class="topic-description">By: <span class="user-highlight">{{$tr->thread->username}}</span></p>
                    </div>
                    <div class="topic-threads">{{$tr->thread->countReplies}}</div>
                    <div class="topic-posts">{{$tr->thread->views}}</div>
                    <div class="topic-latest">
                        @if($tr->lastResponse)
                        <div class="topic-latest-avatar">
                            <img src="{{asset('assets/img/'.$tr->lastResponse->avatar)}}" class="tlt-avatar">
                        </div>
                        <div class="topic-latest-thread">
                            @if(strlen($tr->lastResponse->shortenedContent) == 15)
                                <p class="tlt-name">Re: {{$tr->lastResponse->shortenedContent}}...</p>
                            @else
                                <p class="tlt-name">Re: {{$tr->lastResponse->shortenedContent}}</p>
                            @endif
                            <p class="tlt-username">By: <span class="user-highlight">{{$tr->lastResponse->username}}</span></p>
                            <p class="tlt-date">{{$tr->lastResponse->created_at}}</p>
                        </div>
                        @endif
                    </div>

                    @if(Session::get('user') && Session::get('user')->user_privilege_id == 2)
                        <div class="admin-options topic-admin-options">
                            <button type="submit" class="admin-option-button admin-delete"><a href="/thread/remove/{{$tr->thread->threadId}}">Delete</a></button>
                            <div class="admin-button-wrapper">
                                <button class="admin-option-button admin-edit"><a href="/thread/edit/{{$tr->thread->threadId}}">Edit</a></button>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        @if(count($threadsAndReplies) == 0)
            <p class="no-content-topic">No threads with these search parameters found.</p>
        @endif
    </div>
    <div id="pagination">
        <ul id="pagination-list">
            @for($i = 0; $i < $numberOfPages; $i++)
                @if ($i == request('pagination'))
                    <input type="radio" name="pagination" value="{{$i}}" id="page-{{$i}}" checked>
                    <label for="page-{{$i}}" class="pagination-page selected-pagination">{{$i + 1}}</label>
                @else
                    <input type="radio" name="pagination" value="{{$i}}" id="page-{{$i}}">
                    <label for="page-{{$i}}" class="pagination-page">{{$i + 1}}</label>
                @endif
            @endfor
        </ul>
    </div>
    </form>
    <div id="index-info">
        @include('partials.user_statistics')
    </div>

@endsection
