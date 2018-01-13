@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" class="style">
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
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-o"></i> Add Lead
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminLeadController@store']) !!}
                    {!! Form::hidden('added_by',  Auth::user()->id) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('status_id', 'Status:') !!}
                                {!! Form::select('status_id', [0 => 'Select a Status'] + $status, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('source_id', 'Source:') !!}
                                {!! Form::select('source_id', [0 => 'Select a Source'] + $sources, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('assigned_to', 'Assigned To:') !!}
                                {!! Form::select('assigned_to', $admins, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('country_id', 'Country:') !!}
                                {!! Form::select('country_id', $countries, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('title', 'Title / Position:') !!}
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('state', 'State:') !!}
                                {!! Form::text('state', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('city', 'City:') !!}
                                {!! Form::text('city', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Company', 'Company:') !!}
                                {!! Form::text('company', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('address', 'Address:') !!}
                                {!! Form::text('address', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('phonenumber', 'Phonenumber:') !!}
                                {!! Form::text('phonenumber', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('zipcode', 'Zip code:') !!}
                                {!! Form::text('zipcode', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('website', 'Website:') !!}
                                {!! Form::text('website', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('default_language', 'Default Language:') !!}
                                {!! Form::select('default_language', $languages, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description',  null, ['class' => 'form-control', 'rows' => '5']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-check">
                                {!! Form::hidden('contacted_today', 0) !!}
                                {!! Form::checkbox('contacted_today','1', true, ['class' => 'form-check-input']) !!}
                                {!! Form::label('contacted_today', 'Contacted Today?') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create Lead', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-locales.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    @endsection

