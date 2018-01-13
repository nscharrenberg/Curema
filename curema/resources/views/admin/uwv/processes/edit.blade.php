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
                        <i class="fa fa-recycle"></i> Update UWV Process
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['Addons\AdminUwvProcessController@update', $process->id]]) !!}
                    <div class="form-group">
                        {!! Form::label('ordernr', 'Order number:') !!}
                        {!! Form::text('ordernr_dis', $process->ordernr, ['class' => 'form-control', 'disabled'=> true]) !!}
                        {!! Form::hidden('ordernr', $process->ordernr) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('client_id', 'Client:') !!}
                                {!! Form::select('client_id_dis',$clients, $process->client_id, ['class' => 'form-control select', 'disabled'=> true, 'data-live-search' => 'true']) !!}
                                {!! Form::hidden('client_id', $process->client_id) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('contacts[]', 'UWV Contacts:') !!}
                                {!! Form::select('contacts[]',$contacts,  $processContacts, ['class' => 'form-control select', 'multiple' => true, 'data-live-search' => 'true']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('start_date', 'Assignment Date:') !!}
                                {!! Form::text('start_date', $process->start_date, ['class' => 'form-control', 'id' => 'date']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('end_date', 'Process Duration (months):') !!}
                                {!! Form::number('end_date', $process->end_date->diffInMonths($process->start_date), ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('uwv_service_id', 'Service State:') !!}
                        {!! Form::select('uwv_service_id',$services, $process->uwv_service_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update UWV Process', ['class' => 'btn btn-primary']) !!}
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
        });
    </script>
@endsection