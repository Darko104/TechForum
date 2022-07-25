@extends('layouts.admin_panel')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header table-header">
                    <h5 class="card-title mb-0">Latest Projects</h5>
                    <input type="text" id="panel-search-topics" class="form-control search-table" placeholder="Search">
                </div>
                <table class="table table-hover my-0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th class="d-none d-xl-table-cell">Threads</th>
                        <th class="d-none d-xl-table-cell">Posts</th>
                        <th class="d-none d-xl-table-cell">Total Visits</th>
                        <th class="d-none d-xl-table-cell">Edit</th>
                        <th class="d-none d-xl-table-cell">Remove</th>
                        {{--                            <th>Status</th>--}}
                        {{--                            <th class="d-none d-md-table-cell">Assignee</th>--}}
                    </tr>
                    </thead>
                    <tbody id="table-body">
                    @foreach($topics as $topic)
                        <tr>
                            <td><a href="{{$topic->link}}">{{$topic->general->name}}</a></td>
                            <td>{{$topic->countThreads}}</td>
                            <td>{{$topic->countPosts}}</td>
                            <td>{{$topic->general->views}}</td>
                            <td><button class="admin-option-button admin-edit"><a href="/topic/edit/{{$topic->general->id}}">Edit</a></button></td>
                            <td><button class="admin-option-button admin-delete"><a href="/topic/remove/{{$topic->general->id}}">Delete</a></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
