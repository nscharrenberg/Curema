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
                        <i class="fa fa-user-o"></i> Update Lead
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminLeadController@update', $lead->id]]) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('status_id', 'Status:') !!}
                                {!! Form::select('status_id', [0 => 'Select a Status'] + $status, $lead->status_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('source_id', 'Source:') !!}
                                {!! Form::select('source_id', [0 => 'Select a Source'] + $sources, $lead->source_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('assigned_to', 'Assigned To:') !!}
                                {!! Form::select('assigned_to', $admins, $lead->assigned_to, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('name', 'Name:') !!}
                                {!! Form::text('name', $lead->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('country_id', 'Country:') !!}
                                {!! Form::select('country_id', $countries, $lead->country_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('title', 'Title / Position:') !!}
                                {!! Form::text('title', $lead->title, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('state', 'State:') !!}
                                {!! Form::text('state', $lead->state, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('email', 'Email:') !!}
                                {!! Form::email('email', $lead->email, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('city', 'City:') !!}
                                {!! Form::text('city', $lead->city, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('Company', 'Company:') !!}
                                {!! Form::text('company', $lead->company, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('address', 'Address:') !!}
                                {!! Form::text('address', $lead->address, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('phonenumber', 'Phonenumber:') !!}
                                {!! Form::text('phonenumber', $lead->phonenumber, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('zipcode', 'Zip code:') !!}
                                {!! Form::text('zipcode', $lead->zipcode, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('website', 'Website:') !!}
                                {!! Form::text('website', $lead->website, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('default_language', 'Default Language:') !!}
                                {!! Form::select('default_language', $languages, $lead->default_language, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description',  $lead->description, ['class' => 'form-control', 'rows' => '5']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::hidden('contacted_today', 0) !!}
                                {!! Form::checkbox('contacted_today','1', Carbon\Carbon::parse($lead->last_contact)->format('M d Y') == $today->format('M d Y') ? true : false, ['class' => 'form-check-input']) !!}
                                {!! Form::label('contacted_today', 'Contacted Today?') !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Update Lead', ['class' => 'btn btn-primary']) !!}
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

