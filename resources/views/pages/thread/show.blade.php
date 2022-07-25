@extends('layouts.layout')

@section('content')

    <div id="category-title">
        <h3>{{$thread->title}}</h3>
    </div>
    <div id="thread-options">
        <button type="button" id="new-topic"><a href="{{ route('reply.add', ['threadId' => request('threadId')]) }}">Reply <i class="fa-solid fa-pen"></i></a></button>
    </div>
    <div id="thread-responses">
        @foreach($responsesAndImages as $response)
            <div class="single-reply">
                <div class="reply-user">
                    <img src="{{asset('assets/img/'.$response->response->avatar)}}" class="reply-avatar">
                    <div class="reply-user-info">
                        <p class="reply-username user-highlight">{{$response->response->username}}</p>
                        <p class="reply-role">{{$response->response->privilegeName}}</p>
                        <p class="reply-posts">Posts: <span>441</span></p>
                        <p class="reply-location">Location:
                            <span>
                                @if($response->response->location){{$response->response->location}}
                                @else /
                                @endif
                            </span>
                        </p>
                    </div>
                </div>
                <div class="reply-content">
                    <div class="rc-header">
                        <p>{{$response->response->responseCreation}}</p>

                        @if($response->response->main != 1 && Session::get('user') && Session::get('user')->user_privilege_id == 2)
                            <div class="admin-options reply-admin-options">
                                <form action="{{ route('reply.remove', ['responseId' => $response->response->responseId]) }}" method="POST" class="admin-button-wrapper">
                                    <button type="submit" class="admin-option-button admin-delete" style="padding: 8px;">Delete</button>
                                    @csrf
                                </form>
                                <div class="admin-button-wrapper">
                                    <button type="button" class="admin-option-button admin-edit"><a href="/reply/edit/{{$response->response->responseId}}">Edit</a></button>
                                </div>
                            </div>
                        @endif

                        <a href="{{route('reply.add', ['threadId' => request('threadId'), 'responseId' => $response->response->responseId])}}" class="quote-reply"><i class="fa-solid fa-quote-left"></i></a>
                    </div>
                    <div class="rc-message">
                        @if(isset($response->reply))
                            <div id="rcm-preview" class="response-preview">
                                <p class="response-preview-header">Message written by <span>{{$response->reply->username}}</span>:</p>
                                <p class="response-preview-text">"{{$response->reply->content}}"</p>
                            </div>
                        @endif
                        <p>{{$response->response->content}}</p>
                        <div class="rcm-images">
                            @if($response->images)
                            <div class="rcm-images-wrapper">
                                @foreach($response->images as $image)
                                    <img src="{{asset('assets/img/'.$image->image_name)}}" class="rcm-image" data-name="{{$image->image_name}}">
                                @endforeach
                            </div>
                            <p class="open-image-notif">Click on images to view in full screen</p>
                            @endif
                        </div>
                    </div>
                    <div class="rc-signature">
                        @if ($response->response->signature)
                        <p>{{$response->response->signature}}</p>
                        @else
                        <p style="font-style: italic;">No signature provided</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div id="pagination">
        <form method="GET" id="responses-form">
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
            @csrf
        </form>
    </div>

    <section class="full-page-cover">
        <img src="{{asset('assets/img/1649758779.jpg')}}" id="full-page-cover-image">

        <p id="close-full-page">X</p>
    </section>

@endsection
