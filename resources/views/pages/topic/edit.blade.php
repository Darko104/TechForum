@extends('layouts.layout')

@section('content')

    <div class="basic-container divided-container">
        <div id="write-message-wrapper">
            <h1 class="dc-title">Edit Topic</h1>
            <form action="{{route('topic.doEdit', ['topicId' => request('topicId')])}}" method="POST" enctype="multipart/form-data" id="new-thread-form" onsubmit="return topic.validateEditingTopic()">
                @if (count($errors) > 0)
                    <div id="register-error-list" class="form-error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-circle"></i><span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="label-input ">
                    <label for="topic-tname">Name</label>
                    <input type="text" name="topic-tname" id="topic-tname" value="{{$topic->name}}">
                    <p id="topic-tname-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <button type="submit" id="submit-topic" class="main-color-button">Submit</button>
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
