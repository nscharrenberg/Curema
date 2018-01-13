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
                        <i class="fa fa-credit-card-alt"></i> Add Payment Method
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminPaymentTypeController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-check">

                        {!! Form::hidden('show_on_pdf', 0) !!}
                        {!! Form::checkbox('show_on_pdf','1', true, ['class' => 'form-check-input']) !!}
                        {!! Form::label('show_on_pdf', 'Show on PDF') !!}
                    </div>
                    <div class="form-check">

                        {!! Form::hidden('default', 0) !!}
                        {!! Form::checkbox('default','1', true, ['class' => 'form-check-input']) !!}
                        {!! Form::label('default', 'Allowed by Default') !!}
                    </div>
                    <div class="form-check">

                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active','1', true, ['class' => 'form-check-input']) !!}
                        {!! Form::label('active', 'Activated') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Payment Method', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
