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
                        <i class="fa fa-exclamation-triangle"></i> Add UWV Service
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['Addons\AdminUwvServiceController@update', $service->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', $service->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update UWV Service', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
