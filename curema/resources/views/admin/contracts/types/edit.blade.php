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
                    <div class="panel-heading">Contract Type</div>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminContractTypeController@update', $type->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', $type->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Contact Type', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
