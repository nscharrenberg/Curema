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
                    <i class="fa fa-percent"></i> Update Tax
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminTaxController@update', $tax->id]]) !!}
                    {!! Form::hidden('id', $tax->id) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', $tax->name, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('rate', 'Rate:') !!}
                        {!! Form::number('rate', $tax->rate, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Tax', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
