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
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminAnnouncementController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('subject', 'Subject:') !!}
                        {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content_body', 'Content:') !!}
                        {!! Form::textarea('content_body', null, ['class' => 'form-control', 'rows' => '3']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showToClients', 0) !!}
                                {!! Form::checkbox('showToClients','1', true, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showToClients', 'Show To Client?') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showToStaff', 0) !!}
                                {!! Form::checkbox('showToStaff','1', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showToStaff', 'Show To Staff?') !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('showMyName', 0) !!}
                                {!! Form::checkbox('showMyName','1', false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showMyName', 'Show My Name?') !!}
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
