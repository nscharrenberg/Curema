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
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-md"></i> Add UWV Contact person
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['Addons\AdminUwvContactController@update', $contact->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('firstname', 'Firstname:') !!}
                        {!! Form::text('firstname', $contact->firstname, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname', 'Lastname:') !!}
                        {!! Form::text('lastname', $contact->lastname, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', $contact->email, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phonenumber', 'Phonenumber:') !!}
                        {!! Form::text('phonenumber', $contact->phonenumber, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update UWV Contact', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
