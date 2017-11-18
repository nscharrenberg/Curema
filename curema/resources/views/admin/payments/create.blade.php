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
                    <div class="panel-heading">Payment Methods</div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminPaymentTypeController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('show_on_pdf', 'Show on PDF:') !!}
                        {!! Form::hidden('show_on_pdf', 0) !!}
                        {!! Form::checkbox('show_on_pdf','1', true, ['class' => 'form-check-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('default', 'Allowed by Default:') !!}
                        {!! Form::hidden('default', 0) !!}
                        {!! Form::checkbox('default','1', true, ['class' => 'form-check-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Activated:') !!}
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active','1', true, ['class' => 'form-check-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Payment Method', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
