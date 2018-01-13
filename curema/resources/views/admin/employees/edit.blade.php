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
                        <i class="fa fa-user-secret"></i> Update Employee
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminEmployeeController@update', $employee->id]]) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('firstname', 'Firstname:') !!}
                                {!! Form::text('firstname', $employee->firstname, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('lastname', 'Lastname:') !!}
                                {!! Form::text('lastname', $employee->lastname, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email', $employee->email, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('phonenumber', 'Phonenumber:') !!}
                        {!! Form::text('phonenumber', $employee->phonenumber, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('facebook', 'Facebook:') !!}
                                {!! Form::text('facebook', $employee->facebook, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('linkedin', 'Linked In:') !!}
                                {!! Form::text('linkedin', $employee->linkedin, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('default_language', 'Language:') !!}
                        {!! Form::select('default_language',$languages, $employee->default_language, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hourly_rate', 'Hourly Rate:') !!}
                        {!! Form::number('hourly_rate', $employee->hourly_rate, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email_signature', 'Signature:') !!}
                        {!! Form::textarea('email_signature', $employee->email_signature, ['class' => 'form-control', 'rows' => '2']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('agent', 'Support Agent:') !!}
                                {!! Form::select('agent', ['1' => 'Yes', '0' => 'No'], $employee->agent, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('departments[]', 'Agents:') !!}
                                {!! Form::select('departments[]',$departments, $employeeDepartments, ['class' => 'form-control select', 'multiple' => true, 'data-live-search' => 'true']) !!}
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
                        {!! Form::submit('Update Employee', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection