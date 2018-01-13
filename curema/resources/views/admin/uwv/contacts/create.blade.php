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
                    {!! Form::open(['method' => 'POST', 'action' => 'Addons\AdminUwvContactController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('firstname', 'Firstname:') !!}
                        {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname', 'Lastname:') !!}
                        {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phonenumber', 'Phonenumber:') !!}
                        {!! Form::text('phonenumber', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add UWV Contact', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
