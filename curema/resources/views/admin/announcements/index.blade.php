@extends('layouts.app')

@section('content')
    @if(Session::has('created_announcement'))
        <div class="alert alert-success">
            <p>{{session('created_announcement')}}</p>
        </div>
    @endif

    @if(Session::has('updated_announcement'))
        <div class="alert alert-success">
            <p>{{session('updated_announcement')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_announcement'))
        <div class="alert alert-success">
            <p>{{session('deleted_announcement')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_failed_announcement'))
        <div class="alert alert-danger">
            <p>{{session('deleted_failed_announcement')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-bullhorn"></i> Announcements
                        <a href="{{route('admin.announcements.create')}}" class="btn btn-primary pull-right"> Create new Announcement</a>
                    </div>
                    <div class="card-body card-fullwidth">
                        @if(count($announcements) > 0)
                        <table class="table table-hover">
                            <thead class="thead-primary">
                            <tr>
                                <th>Subject</th>
                                <th>Content</th>
                                <th>Dismissed</th>
                                <th>Posted by</th>
                                <th>Posted on</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($announcements as $announcement)
                                    <tr>
                                        <td>{{$announcement->subject}}</td>
                                        <td>{{$announcement->content}}</td>
                                        <td>{{$announcement->dismissed ? "Yes" : "No"}}</td>
                                        <td>{{$announcement->admin->fullName}}</td>
                                        <td>{{$announcement->created_at->diffForHumans()}}</td>
                                        <td>
                                            <a href="{{route('admin.announcements.edit', $announcement->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                            @else
                            <h2>No Announcements</h2>
                        @endif
                    </div>
                </div>
            </div>

                @if(auth()->user()->admin)
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bullhorn"></i> Dismissed Announcements
                        </div>
                        <div class="card-body card-fullwidth">
                            <table class="table table-hover">
                                <thead class="thead-primary">
                                <tr>
                                    <th>Subject</th>
                                    <th>Content</th>
                                    <th>Dismissed</th>
                                    <th>Posted by</th>
                                    <th>Posted on</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($dismissed) > 0)
                                    @foreach($dismissed as $announcement)
                                        <tr>
                                            <td>{{$announcement->subject}}</td>
                                            <td>{{$announcement->content}}</td>
                                            <td>{{$announcement->dismissed ? "Yes" : "No"}}</td>
                                            <td>{{$announcement->admin->fullName}}</td>
                                            <td>{{$announcement->created_at->diffForHumans()}}</td>
                                            <td>
                                                <a href="{{route('admin.announcements.edit', $announcement->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                                {!! Form::model($announcement, ['method' => 'DELETE', 'action' => ['AdminAnnouncementController@destroy', $announcement->id]]) !!}
                                                {!! Form::hidden('', $announcement->id) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
