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
                        <i class="fa fa-file-text-o "></i> Update Contract
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminContractController@update', $contract->id]]) !!}
                    <div class="row">
                        <div class=" col-md-6">
                            <div class="form-group">
                                {!! Form::label('client_id', 'Customer:') !!}
                                {!! Form::select('client_id', [0 => 'Select a Customer'] + $clients, $contract->client_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('subject', 'Subject:') !!}
                                {!! Form::text('subject', $contract->subject, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('type_id', 'Contract Type:') !!}
                                {!! Form::select('type_id', $types, $contract->type_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        {!! Form::label('currency_id', 'Currency:') !!}
                                        {!! Form::select('currency_id', $currencies, $contract->currency_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                    </div>
                                    <div class="col-md-8">
                                        {!! Form::label('value', 'Value:') !!}
                                        {!! Form::number('value', $contract->value, ['class' => 'form-control', 'steps' => '0.01']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('start_date', 'Start Date:') !!}
                                        {!! Form::text('start_date', $contract->start_date, ['class' => 'form-control', 'id' => 'start_date']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('end_date', 'End Date:') !!}
                                        {!! Form::text('end_date', $contract->end_date, ['class' => 'form-control', 'id' => 'end_date']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description:') !!}
                                {!! Form::textarea('description', $contract->description, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                {!! Form::label('content_body', 'Content:') !!}
                                {!! Form::textarea('content_body', $contract->content, ['class' => 'form-control', 'rows' => 22]) !!}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::hidden('showToClient', 0) !!}
                                {!! Form::checkbox('showToClient','1', $contract->showToClient, ['class' => 'form-check-input']) !!}
                                {!! Form::label('showToClient', 'Show To Client:') !!}
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    <br>
                                    {!! Form::submit('Update Contract', ['class' => 'btn btn-primary']) !!}
                                </div>
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
            $('#start_date').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#end_date').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        });
    </script>

@endsection