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
                    <div class="panel-heading">Clients</div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminClientController@store']) !!}
                        <div class="form-group">
                            {!! Form::label('company', 'Company:') !!}
                            {!! Form::text('company', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('country', 'Country:') !!}
                            {!! Form::select('country_id', [0 => 'Select a country'] + $countries, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('state', 'State:') !!}
                            {!! Form::text('state', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'City:') !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Address:') !!}
                            {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('zipcode', 'Zipcode:') !!}
                            {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('currency_id', 'Default Currency:') !!}
                            {!! Form::select('currency_id', [0 => 'Select a Currency'] + $currencies, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('active', 'Activated:') !!}
                            {!! Form::hidden('active', 0) !!}
                            {!! Form::checkbox('active','1', true, ['class' => 'form-check-input']) !!}
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
