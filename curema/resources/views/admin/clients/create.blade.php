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
                        <i class="fa fa-users"></i> Add a Customer
                    </div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'POST', 'action' => 'AdminClientController@store']) !!}
                            <div class="form-group">
                                {!! Form::label('company', 'Company:') !!}
                                {!! Form::text('company', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('country', 'Country:') !!}
                                {!! Form::select('country_id',[0 => 'Select a Country'] + $countries, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
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
                                {!! Form::select('currency_id',[0 => 'Select a Currency'] + $currencies, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Add Client', ['class' => 'btn btn-primary']) !!}
                            </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('select').extendSelect({
            // Search input placeholder:
            search: 'Find',
            // Title if option not selected:
            notSelectedTitle: 'Select an option',
            // Message if select list empty:
            empty: 'Empty',
            // Class to active element
            activeClass: 'active',
            // Class to disabled element
            disabledClass: 'disabled',
            // Custom error message for all selects (use placeholder %items)
            maxOptionMessage: 'Max %items elements',
            // Delay to hide message
            maxOptionMessageDelay: 2000,
            // Popover logic (resize or save height)
            popoverResize: true,
            // Auto resize dropdown by button width
            dropdownResize: true
        });
    </script>
@endsection