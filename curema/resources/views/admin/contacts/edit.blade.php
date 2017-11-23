@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" class="style">
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
                    <div class="panel-heading">Contact Moment with <strong>{{$client->company}}</strong></div>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminClientContactController@update', $client->id, $contactMoment->id]]) !!}
                    {!! Form::hidden('client_id', $client->id) !!}
                    <div class="form-group">
                        {!! Form::label('contact_id', 'Contact Person:') !!}
                        {!! Form::select('contact_id', $contacts, $contactMoment->contact_id, ['class' => 'form-control selectpicker']) !!}
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
                            {!! Form::select('type_id', $types,$contactMoment->type_id, ['class' => 'form-control', 'id' => 'date']) !!}
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
                                {!! Form::submit('Add Contact Moment to ' . $client->company, ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-locales.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

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
@endsection