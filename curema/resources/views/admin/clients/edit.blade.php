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
                    <div class="panel-heading">Edit {{$client->id}} </div>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminClientController@update', $client->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('company', 'Company:') !!}
                        {!! Form::text('company', $client->company, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('country', 'Country:') !!}
                        {!! Form::select('country_id', [0 => 'Select a country'] + $countries, $client->country_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('state', 'State:') !!}
                        {!! Form::text('state', $client->state, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('city', 'City:') !!}
                        {!! Form::text('city', $client->city, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Address:') !!}
                        {!! Form::text('address', $client->address, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('zipcode', 'Zipcode:') !!}
                        {!! Form::text('zipcode', $client->zipcode, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('currency_id', 'Default Currency:') !!}
                        {!! Form::select('currency_id', [0 => 'Select a Currency'] + $currencies, $client->currency_id, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('active', 'Activated:') !!}
                        {!! Form::hidden('active', 0) !!}
                        {!! Form::checkbox('active','1', $client->active, ['class' => 'form-check-input']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Add Client', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection