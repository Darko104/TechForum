@extends('layouts.layout')

@section('content')

    <div id="user-posts" class="basic-container">
        <p id="user-title" class="lighter-title">Past posts</p>
        <table id="user-posts-table-auth" class="user-posts-table">
            <tr>
                <th class="user-post-type">type</th>
                <th>thread</th>
                <th>message</th>
                <th>replies count</th>
                <th>date</th>
            </tr>
            @foreach($posts as $post)
            <tr>
                <td class="user-post-type">@if(isset($post->threadId)) Thread @elseif(isset($post->responseId)) Reply @endif</td>
                <td class="user-post-title">
                    <p class="user-post-thread">{{$post->title}}</p>
                    <p class="user-post-category">Troubleshooting</p>
                </td>
                <td>
                    @if(strlen($post->shortenedContent) == 120)
                        <p class="user-post-message">{{$post->shortenedContent}} ...</p>
                    @else
                        <p class="user-post-message">{{$post->shortenedContent}}</p>
                    @endif
                </td>
                <td class="user-post-replies">{{$post->countReplies}}</td>
                <td class="user-post-date">{{$post->creationDate}}</td>
            </tr>
            @endforeach
        </table>
    </div>

@endsection
