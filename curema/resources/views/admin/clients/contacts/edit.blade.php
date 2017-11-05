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
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminUserController@update', $contact->client_id, $contact->id]]) !!}
                    {!! Form::hidden('client_id', $contact->client_id) !!}
                    <div class="form-group">
                        {!! Form::label('firstname', 'Firstname:') !!}
                        {!! Form::text('firstname', $contact->firstname, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname', 'Lastname:') !!}
                        {!! Form::text('lastname', $contact->lastname, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'E-mail:') !!}
                        {!! Form::email('email', $contact->email, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phonenumber', 'Phonenumber:') !!}
                        {!! Form::text('phonenumber', $contact->phonenumber, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('default_language', 'Default Language:') !!}
                        {!! Form::select('default_language', $languages, $contact->default_language, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Activated:') !!}
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active','1', $contact->active, ['class' => 'form-check-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('is_primary', 'Primary Contact:') !!}
                        @if($contact->client->primary_contact_id == $contact->id)
                            {!! Form::checkbox('is_primary','1', true, ['class' => 'form-check-input']) !!}
                            @else
                            {!! Form::checkbox('is_primary','1', false, ['class' => 'form-check-input']) !!}
                            @endif
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
