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
                        <i class="fa fa-user-secret"></i> Add Employee
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminEmployeeController@store']) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('firstname', 'Firstname:') !!}
                                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('lastname', 'Lastname:') !!}
                                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
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
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('facebook', 'Facebook:') !!}
                                {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('linkedin', 'Linked In:') !!}
                                {!! Form::text('linkedin', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('default_language', 'Language:') !!}
                        {!! Form::select('default_language',$languages, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hourly_rate', 'Hourly Rate:') !!}
                        {!! Form::number('hourly_rate', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email_signature', 'Signature:') !!}
                        {!! Form::textarea('email_signature', null, ['class' => 'form-control', 'rows' => '2']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('agent', 'Support Agent:') !!}
                                {!! Form::select('agent', ['1' => 'Yes', '0' => 'No'], 0, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('departments[]', 'Agents:') !!}
                                {!! Form::select('departments[]',$departments, null, ['class' => 'form-control select', 'multiple' => true, 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                <div class="form-check">
                                    {!! Form::hidden('active', 0) !!}
                                    {!! Form::checkbox('active','1', true, ['class' => 'form-check-input', 'id' => 'active']) !!}
                                    {!! Form::label('active', 'Activated', ['class' => 'form-check-label', 'for' => 'active']) !!}
                                </div>
                            <div class="form-check">
                                {!! Form::hidden('admin', 0) !!}
                                {!! Form::checkbox('admin','1', false, ['class' => 'form-check-input', 'id' => 'admin']) !!}
                                {!! Form::label('admin', 'Is Admin', ['class' => 'form-check-label', 'for' => 'admin']) !!}
                            </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Add Employee', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
