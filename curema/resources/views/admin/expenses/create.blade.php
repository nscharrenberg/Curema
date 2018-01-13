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
                        <i class="fa fa-credit-card"></i> Add Expense
                    </div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminExpenseController@store']) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('prefix', 'Prefix') !!}
                                {!! Form::text('prefix', "EXP-", ['class' => 'form-control', 'disabled' => true]) !!}
                            </div>
                            <div class="col-md-9">
                                {!! Form::label('number', 'number:') !!}
                                {!! Form::number('number', null, ['class' => 'form-control', 'step' => '1']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('category_id', 'Expense Category:') !!}
                        {!! Form::select('category_id', $categories, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('note', 'Description:') !!}
                        {!! Form::textarea('note',  null, ['class' => 'form-control', 'rows' => 3]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date', 'Date:') !!}
                        {!! Form::text('date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                {!! Form::label('currency_id', 'Currency:') !!}
                                {!! Form::select('currency_id', $currencies, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="col-md-9">
                                {!! Form::label('amount', 'Amount (total):') !!}
                                {!! Form::number('amount', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('tax_percentage', 'Tax Percentage:') !!}
                        {!! Form::number('tax_percentage', null, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <hr>
                    <div class="form-group">
                        {!! Form::label('client_id', 'Client (optional):') !!}
                        {!! Form::select('client_id', $clients, null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Add Expense', ['class' => 'btn btn-primary']) !!}
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