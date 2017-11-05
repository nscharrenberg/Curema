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
                    <div class="panel-heading">Clients</div>
                    {!! Form::open(['method' => 'POST', 'action' => ['AdminUserController@store', $client->id]]) !!}
                        {!! Form::hidden('client_id', $client->id) !!}
                        <div class="form-group">
                            {!! Form::label('firstname', 'Firstname:') !!}
                            {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('lastname', 'Lastname:') !!}
                            {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'E-mail:') !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Password:') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phonenumber', 'Phonenumber:') !!}
                            {!! Form::text('phonenumber', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('default_language', 'Default Language:') !!}
                            {!! Form::select('default_language', $languages, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Activated:') !!}
                            {!! Form::hidden('active', 0) !!}
                            {!! Form::checkbox('active','1', true, ['class' => 'form-check-input']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('is_primary', 'Primary Contact:') !!}
                            {!! Form::checkbox('is_primary','1', false, ['class' => 'form-check-input']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Add Contact', ['class' => 'btn btn-primary']) !!}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
