@extends('layouts.layout')

@section('content')
    <div class="basic-container divided-container">
        <div id="write-message-wrapper">
            <h1 class="dc-title">Edit Reply</h1>
            <form action="{{ route('reply.doEdit', ['responseId' => request('responseId')]) }}" method="POST" enctype="multipart/form-data" id="new-thread-form" onsubmit="return thread.validateAddingReply()">
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
                    <label for="thread-text">Message</label>
                    <textarea name="thread-text" id="thread-text">{{$response->content}}</textarea>
                    <p id="thread-text-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                @if(count($images) > 0)
                    <div id="thread-images">
                        <p id="thread-images-title">Images in this response (they will instantly get deleted)</p>
                        <div id="thread-images-preview-add">
                            <div id="image-previews">
                                @foreach($images as $image)
                                    <div class="image-preview-wrapper" data-id="{{$image->id}}">
                                        <div class="image-preview" style="background-image: url('{{asset('assets/img/'.$image->image_name)}}')" data-serial="{{$image->id}}"></div>
                                        <div class="cancel-image edit-remove-image" data-id="{{$image->id}}">X</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
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
