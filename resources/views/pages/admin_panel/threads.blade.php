@extends('layouts.admin_panel')

@section('content')

    <div class="row">
        <div class="col-12 col-lg-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header table-header">
                    <h5 id="whatever" class="card-title mb-0">Latest Projects</h5>
                    <input type="text" id="panel-search-threads" class="form-control search-table" placeholder="Search">
                </div>
                <table class="table table-hover my-0">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th class="d-none d-xl-table-cell">Topic</th>
                        <th class="d-none d-xl-table-cell">Responses</th>
                        <th class="d-none d-xl-table-cell">Total Visits</th>
                        <th class="d-none d-xl-table-cell">Edit</th>
                        <th class="d-none d-xl-table-cell">Remove</th>
                        {{--                            <th>Status</th>--}}
                        {{--                            <th class="d-none d-md-table-cell">Assignee</th>--}}
                    </tr>
                    </thead>
                    <tbody id="table-body">
                    @foreach($threads as $thread)
                        <tr>
                            <td><a href="{{route('thread', ['threadId' => $thread->threadId])}}">{{$thread->title}}</a></td>
                            <td>{{$thread->topicName}}</td>
                            <td>{{$thread->countReplies}}</td>
                            <td>{{$thread->threadViews}}</td>
                            <td><button class="admin-option-button admin-edit"><a href="/thread/edit/{{$thread->threadId}}">Edit</a></button></td>
                            <td><button class="admin-option-button admin-delete"><a href="/thread/remove/{{$thread->threadId}}">Delete</a></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
