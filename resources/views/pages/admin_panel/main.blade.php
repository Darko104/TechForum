@extends('layouts.admin_panel')

@section('content')

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

        <div class="row">
            <div class="col-xl-12 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Threads</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-file"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{$threadCount}}</h1>
                                    <div class="mb-0">
                                        <span class="text-muted"> <i class="mdi mdi-arrow-bottom-right"></i> {{$threadCountRecent}} </span>
                                        <span class="text-muted">In the past 24 hours</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Users</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{$usersCount}}</h1>
                                    <div class="mb-0">
                                        <span class="text-muted"> <i class="mdi mdi-arrow-bottom-right"></i> {{$usersCountRecent}} </span>
                                        <span class="text-muted">Since last month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Thread Responses</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-envelope-open-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{$responsesCount}}</h1>
                                    <div class="mb-0">
                                        <span class="text-muted"> <i class="mdi mdi-arrow-bottom-right"></i> {{$responsesCountRecent}} </span>
                                        <span class="text-muted">In the past 24 hours</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Total Visits</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="stat text-primary">
                                                <i class="fa-solid fa-eye"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="mt-1 mb-3">{{$totalVisits}}</h1>
                                    <div class="mb-0" style="visibility: hidden">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                        <span class="text-muted">Since last week</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header table-header">
                        <h5 class="card-title mb-0">Pages</h5>
                    </div>
                    <table class="table table-hover my-0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th class="d-none d-xl-table-cell">Page Type</th>
                            <th class="d-none d-xl-table-cell">Total Visits</th>
{{--                            <th>Status</th>--}}
{{--                            <th class="d-none d-md-table-cell">Assignee</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            <tr>
                                <td>{{$page->name}}</td>
                                <td class="d-none d-xl-table-cell">{{$page->type}}</td>
                                <td class="d-none d-xl-table-cell">{{$page->views}}</td>
                            </tr>
                        @endforeach
                        @foreach($topics as $topic)
                            <tr>
                                <td>{{$topic->name}}</td>
                                <td class="d-none d-xl-table-cell">Browsing</td>
                                <td class="d-none d-xl-table-cell">{{$topic->views}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
