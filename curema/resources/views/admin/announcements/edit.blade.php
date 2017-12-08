@extends('layouts.app')

@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Announcement</div>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminAnnouncementController@update', $announcement->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('subject', 'Subject:') !!}
                        {!! Form::text('subject', $announcement->subject, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content_body', 'Content:') !!}
                        {!! Form::textarea('content_body', $announcement->content, ['class' => 'form-control', 'rows' => '3']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showToClients', 0) !!}
                                {!! Form::checkbox('showToClients','1', $announcement->showToClients ? true : false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showToClients', 'Show To Client?') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showToStaff', 0) !!}
                                {!! Form::checkbox('showToStaff','1', $announcement->showToStaff ? true : false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showToStaff', 'Show To Staff?') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showMyName', 0) !!}
                                {!! Form::checkbox('showMyName','1', $announcement->showMyName ? true : false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showMyName', 'Show My Name?') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('dismissed', 0) !!}
                                {!! Form::checkbox('dismissed','1', $announcement->dismissed ? true : false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('dismissed', 'Dismiss Announcement') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Tax', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
