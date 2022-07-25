@extends('layouts.layout')

@section('content')

    @include('partials.greeting')
    <div id="category-title">
        <h3></h3>
    </div>
    <form method="GET" id="topic-form">
        <input type="hidden" name="keyword" value="{{request('keyword')}}">
        <div id="forum-categories-options" class="forum-categories">
            <div class="basic-container forum-category">
                <div class="category-header">
                    <p class="category-name">Search results</p>
                    <p class="info-title">replies</p>
                    <p class="info-title">views</p>
                    <p class="info-title category-last">last post</p>
                </div>
                @foreach($threadsAndInfo as $tr)
                    <div class="topic-info">
                        <div class="topic-preview">
                            <p class="topic-name"><a href="{{route('thread', ['threadId' => $tr->thread->threadId])}}">{{$tr->thread->title}}</a></p>
                            <p class="topic-description">By: <span class="user-highlight"></span></p>
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
                                    <p class="tlt-username">By: <span class="user-highlight"></span></p>
                                    <p class="tlt-date">{{$tr->lastResponse->created_at}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @if(count($threadsAndInfo) == 0)
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
    </div>

@endsection
