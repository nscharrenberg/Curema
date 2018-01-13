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
                        <i class="fa fa-calculator"></i> Update Estimate
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminEstimateController@update', $estimate->id]]) !!}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('client_id', 'Customer:') !!}
                                    {!! Form::select('client_id', [0 => 'Select a Customer'] + $clients, $estimate->client_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('number', 'Estimate Reference Nr') !!}
                                    {!! Form::number('number', $estimate->number, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::label('date', 'Estimate Date:') !!}
                                        {!! Form::text('date', $estimate->date->format("Y/m/d"), ['class' => 'form-control', 'id' => 'date']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('deadline', 'Due Date:') !!}
                                        {!! Form::text('deadline', $estimate->deadline->format("Y/m/d"), ['class' => 'form-control', 'id' => 'deadline']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::label('currency_id', 'Currency:') !!}
                                        {!! Form::select('currency_id', $currencies, $estimate->currency_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('agent_id', 'Sales Agent:') !!}
                                        {!! Form::select('agent_id', $agents, $estimate->sales_agent, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('admin_note', 'Admin Notes') !!}
                                    {!! Form::textarea('admin_note', $estimate->admin_note, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </div>
                        </div>

                    <div class="col-md-12">
                        <div class="form-group pull-right">
                            {!! Form::label('show_quantity_as', 'Show quantity as: ') !!}
                            <div class=" btn-group" data-toggle="buttons" id="quantity">
                                <label class="btn btn-primary {{$estimate->show_quantity_as == 1 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 1, $estimate->show_quantity_as == 1 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Qty
                                </label>
                                <label class="btn btn-primary {{$estimate->show_quantity_as == 2 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 2, $estimate->show_quantity_as == 2 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Hours
                                </label>
                                <label class="btn btn-primary {{$estimate->show_quantity_as == 3 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 3, $estimate->show_quantity_as == 3 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Qty/Hour
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th></th>
                                <th width="20%">Item Name</th>
                                <th width="25%">Item Description</th>
                                <th width="10%" id="quantityTh">Quantity</th>
                                <th>Rate</th>
                                <th width="20%">Tax</th>
                                <th width="10%">Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="main">
                            @foreach($estimate->items as $item)
                                <tr class="main" >
                                    <td></td>
                                    <td>
                                        {{$item->name}}
                                    </td>
                                    <td>
                                        {{$item->description}}
                                    </td>
                                    <td>
                                        {{$item->quantity}}
                                        {{$item->unit}}
                                    </td>
                                    <td>
                                        {{$item->rate}}
                                    </td>
                                    <td>
                                        @foreach($item->tax as $rate)
                                            {{$rate->rate}}% {{$rate->name}} <br>
                                        @endforeach
                                    </td>
                                    <td>{{$estimate->currency->symbol}}{{$item->rate * $item->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('subtotal', 'Sub Total:') !!}
                                {!! Form::number('subtotal', $estimate->subtotal, ['class' => 'form-control', 'min' => 0.00, 'step' => '0.01', 'id' => 'subtotal']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('discount_percentage', 'Discount (%):') !!}
                                {!! Form::number('discount_percentage', $estimate->discount_percentage, ['class' => 'form-control', 'min' => 0, 'max' => '100', 'step' => '1']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('adjustment', 'Adjustment:') !!}
                                {!! Form::number('adjustment', $estimate->adjustment, ['class' => 'form-control', 'step' => '0.01']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('discount_type', 'Discount Type:') !!}
                            {!! Form::select('discount_type', $discountType, $estimate->discount_type, ['class' => 'form-control select']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('total', 'Total:') !!}
                            {!! Form::text('totalVisible', $estimate->total, ['class' => 'form-control', 'disabled' => true, 'id' => 'totalVisible']) !!}
                            {!! Form::hidden('total_tax', 21, ['id' => 'tax']) !!}
                            {!! Form::hidden('total', $estimate->total, ['id' => 'total']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_note', 'Client Note') !!}
                            {!! Form::textarea('client_note', $estimate->client_note, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('terms', 'Terms of Conditions:') !!}
                            {!! Form::textarea('terms', $estimate->terms, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <br>
                                {!! Form::submit('Update Estimate', ['class' => 'btn btn-primary']) !!}
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
            $('#deadline').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#recurring_ends_on').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#quantity").change(function(evt) {
                $("#quantityTh").html("Quantity");
                var selected;
                selected = $('input[name=show_quantity_as]:checked', '#quantity').val()
                if (selected == 1) {
                    $("#quantityTh").html("Quantity");
                } else if (selected == 2) {
                    $("#quantityTh").html("Hours");
                } else if (selected == 3) {
                    $("#quantityTh").html("Qty/Hour");
                }
            }).change();

        });
    </script>

    {{-- Calculating Total depending on the settings set in previous fields. --}}
    <script type="text/javascript">
        $(document).ready(function(){
            calculatedTotal = 0.00;
            $("#totalVisible").val({{$estimate->total}});
            $("#total").val({{$estimate->total}});
            $('#subtotal').on('change input paste', function(){
                calculateTotal();
            });

            $('#discount_percentage').on('change input paste', function(){
                calculateTotal();
            });

            $('#adjustment').on('change input paste', function(){
                calculateTotal();
            });

        });

        function calculateTotal() {
            discount = ($('#subtotal').val() * ($('#discount_percentage').val() / 100));
            calculatedTotal = ($('#subtotal').val() - discount);
            adjustment = parseFloat($('#adjustment').val());
            calculatedTotal = calculatedTotal + adjustment;
            $("#totalVisible").val(calculatedTotal);
            $('input[name="total"]').val(calculatedTotal);
        }
    </script>
@endsection