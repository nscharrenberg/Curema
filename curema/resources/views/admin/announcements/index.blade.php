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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.announcements.create')}}" class="btn btn-primary"> New Announcement</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Announcements
                    </div>
                    <table class="table table-hover">
                        <thead>
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
                        @if(count($announcements) > 0)
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td>{{$announcement->subject}}</td>
                                    <td>{{$announcement->content}}</td>
                                    <td>{{$announcement->dismissed ? "Yes" : "No"}}</td>
                                    <td>{{$announcement->admin->fullName}}</td>
                                    <td>{{$announcement->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('admin.announcements.edit', $announcement->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>

                @if(auth()->user()->admin)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Announcements
                        </div>
                        <table class="table table-hover">
                            <thead>
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
                                            <a href="{{route('admin.announcements.edit', $announcement->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                            {!! Form::model($announcement, ['method' => 'DELETE', 'action' => ['AdminAnnouncementController@destroy', $announcement->id]]) !!}
                                            {!! Form::hidden('', $announcement->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
