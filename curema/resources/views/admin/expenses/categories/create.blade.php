@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" class="style">
@endsection
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
                    <div class="panel-heading">Expense Category</div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminExpenseCategoryController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Expense Category', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
