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
                        <i class="fa fa-commenting-o"></i> Update Contactmoment of {{$client->company}}
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminClientContactController@update', $client->id, $contactMoment->id]]) !!}
                    {!! Form::hidden('client_id', $client->id) !!}
                    <div class="form-group">
                        {!! Form::label('contact_id', 'Contact Person:') !!}
                        {!! Form::select('contact_id', $contacts, $contactMoment->contact_id, ['class' => 'select']) !!}
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::label('date', 'Appointment Date:') !!}
                            {!! Form::text('date', $contactMoment->date, ['class' => 'form-control', 'id' => 'date']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('start_time', 'Starting Time:') !!}
                            {!! Form::text('start_time', $contactMoment->start_time, ['class' => 'form-control', 'id' => 'start_time']) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('end_time', 'Ending Time:') !!}
                            {!! Form::text('end_time', $contactMoment->end_time, ['class' => 'form-control', 'id' => 'end_time']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::label('type_id', 'Contact Type:') !!}
                            {!! Form::select('type_id', $types,$contactMoment->type_id, ['class' => 'select', 'id' => 'date']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('notes', 'Notes:') !!}
                        {!! Form::textarea('notes', $contactMoment->notes, ['class' => 'form-control']) !!}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::submit('Update Contact Moment of ' . $client->company, ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
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

    {{-- Get DateTimePicker from Bootstrap --}}
    <script type="text/javascript">
        $(function () {
            $('#date').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#start_time').datetimepicker({
                format: 'HH:mm'
            });
            $('#end_time').datetimepicker({
                format: 'HH:mm',
                useCurrent: false
            });

            $("#start_time").on("dp.change", function(e) {
                $('#end_time').data("DateTimePicker").minDate(e.date);
            });

            $("#end_time").on("dp.change", function(e) {
                $('#start_time').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
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