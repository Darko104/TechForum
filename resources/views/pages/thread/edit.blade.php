@extends('layouts.layout')

@section('content')

    <div class="basic-container divided-container">
        <div id="write-message-wrapper">
            <h1 class="dc-title">Edit thread</h1>
            <form action="{{route('thread.doEdit', ['threadId' => request('threadId')])}}" method="POST" enctype="multipart/form-data" id="new-thread-form" onsubmit="return thread.validateAddingThread()">
                @if (count($errors) > 0)
                    <div id="register-error-list" class="form-error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="label-input">
                    <label for="thread-title">Title</label>
                    <input type="text" name="thread-title" id="thread-title" value="{{$thread->title}}">
                    <p id="thread-title-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div class="label-input">
                    <label for="thread-text">Message</label>
                    <textarea name="thread-text" id="thread-text">{{$mainResponse->content}}</textarea>
                    <p id="thread-text-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <button type="submit" id="submit-thread" class="main-color-button">Submit</button>
                @csrf
            </form>
        </div>
        <div id="message-rules-wrapper">
            <h1 class="dc-title">Rules</h1>
            <div id="message-rules">
                <div class="message-rule">
                    <p class="message-rule-title">Lorem</p>
                    <p class="message-rule-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et quidem in atque fuga, quisquam optio commodi harum dolorem voluptas aspernatur accusamus.</p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Lorem ipsum</p>
                    <p class="message-rule-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et quidem in atque fuga.</p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Necessitatibus maxime</p>
                    <p class="message-rule-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro et quidem in atque fuga, quisquam optio commodi harum dolorem voluptas aspernatur accusamus.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
