@extends('layouts.layout')

@section('content')

    <div class="basic-container divided-container">
        <div id="write-message-wrapper">
            <h1 class="dc-title">Create new thread</h1>
            <form action="{{route('thread.doAdd', ['topicId' => request('topicId')])}}" method="POST" enctype="multipart/form-data" id="new-thread-form" onsubmit="return thread.validateAddingThread()">
                @if (count($errors) > 0)
                    <div id="register-error-list" class="form-error-list">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li><i class="fa-solid fa-circle"></i> <span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="label-with-input">
                    <label for="thread-title">Title</label>
                    <input type="text" name="thread-title" id="thread-title">
                    <p id="thread-title-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div class="label-with-input">
                    <label for="thread-text">Message</label>
                    <textarea name="thread-text" id="thread-text"></textarea>
                    <p id="thread-text-info" class="form-error"><i class="fa-solid fa-triangle-exclamation"></i><span></span></p>
                </div>
                <div id="thread-images">
                    <p id="thread-images-title">Add images</p>
                    <div id="thread-images-preview-add">
                        <div id="image-previews">
                        </div>
                        <label id="add-new-image" for="add-image1">+</label>
                        <input type="file" id="add-image1" class="thread-add-image" name="images[]" data-serial="1">
                    </div>
                </div>
                <button type="submit" id="submit-thread" class="main-color-button">Submit</button>
                @csrf
            </form>
        </div>
        <div id="message-rules-wrapper">
            <h1 class="dc-title">Rules</h1>
            <div id="message-rules">
                <div class="message-rule">
                    <p class="message-rule-title">Title</p>
                    <p class="message-rule-desc">Title is required and must have between 2 and 200 characters in length.</p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Text</p>
                    <p class="message-rule-desc">Text is required and must have between 2 and 1000 characters in length.</p>
                </div>
                <div class="message-rule">
                    <p class="message-rule-title">Images</p>
                    <p class="message-rule-desc">Images are not required. More than one image can be added.</p>
                </div>
            </div>
        </div>
    </div>

@endsection
