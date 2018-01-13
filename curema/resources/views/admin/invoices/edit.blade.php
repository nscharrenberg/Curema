@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" class="style">
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
                        <i class="fa fa-file"></i> Update Invoice
                    </div>
                    <div class="card-body">
                    {!! Form::open(['method' => 'PATCH', 'action' => ['AdminInvoiceController@update', $invoice->id]]) !!}
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    {!! Form::label('client_id', 'Customer:') !!}
                                    {!! Form::select('client_id', [0 => 'Select a Customer'] + $clients, $invoice->client_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('number', 'Invoice Reference Nr') !!}
                                    {!! Form::number('number', $invoice->number, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6">
                                        {!! Form::label('date', 'Invoice Date:') !!}
                                        {!! Form::text('date', $invoice->date->format("Y/m/d"), ['class' => 'form-control', 'id' => 'date']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('deadline', 'Due Date:') !!}
                                        {!! Form::text('deadline', $invoice->deadline->format("Y/m/d"), ['class' => 'form-control', 'id' => 'deadline']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-6">
                                <div class="form-group">
                                    {!! Form::label('allowed_payment_types', 'Payment Method:') !!}
                                    {!! Form::select('allowed_payment_types[]', $types, unserialize($invoice->allowed_payment_types), ['class' => 'form-control select', 'data-live-search' => 'true', 'multiple' => true]) !!}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Form::label('currency_id', 'Currency:') !!}
                                        {!! Form::select('currency_id', $currencies, $invoice->currency_id, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::label('agent_id', 'Sales Agent:') !!}
                                        {!! Form::select('agent_id', $agents, $invoice->sales_agent, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('recurring', 'Recurring Invoice?') !!}
                                    {!! Form::select('recurring', $recurring, $invoice->custom_recurring == 1 ? 13 : $invoice->recurring, ['class' => 'form-control select', 'data-live-search' => 'true', 'id' => 'recurring']) !!}
                                </div>
                                <div id="recurringfields">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            {!! Form::number('repeat_every_custom', $invoice->recurring, ['class' => 'form-control', 'id' => 'repeat_every_custom']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::select('repeat_type_custom', $customTypes, $invoice->recurring_type, ['class' => 'form-control select repeat_type_custom', 'data-live-search' => 'true', 'id' => 'repeat_type_custom']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('recurring_ends_on', 'Recurring Ends on? (Leave blank if forever') !!}
                                    {!! Form::text('recurring_ends_on', $invoice->recurring_deadline != null ? $invoice->recurring_deadline->format("Y/m/d") : null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('admin_note', 'Admin Notes') !!}
                                    {!! Form::textarea('admin_note', $invoice->admin_note, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </div>
                        </div>


                    <div class="col-md-12">
                        <div class="form-group pull-right">
                            {!! Form::label('show_quantity_as', 'Show quantity as: ') !!}
                            <div class=" btn-group" data-toggle="buttons" id="quantity">
                                <label class="btn btn-primary {{$invoice->show_quantity_as == 1 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 1, $invoice->show_quantity_as == 1 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Qty
                                </label>
                                <label class="btn btn-primary {{$invoice->show_quantity_as == 2 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 2, $invoice->show_quantity_as == 2 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Hours
                                </label>
                                <label class="btn btn-primary {{$invoice->show_quantity_as == 3 ? "active" : ""}}">
                                    {{ Form::radio('show_quantity_as', 3, $invoice->show_quantity_as == 3 ? true : false, ['class' => 'radio radio-primary radio-inline']) }} Qty/Hour
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
                            @foreach($invoice->items as $item)
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
                                    <td>{{$invoice->currency->symbol}}{{$item->rate * $item->quantity}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('subtotal', 'Sub Total:') !!}
                                {!! Form::number('subtotal', $invoice->subtotal, ['class' => 'form-control', 'min' => 0.00, 'step' => '0.01', 'id' => 'subtotal']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('discount_percentage', 'Discount (%):') !!}
                                {!! Form::number('discount_percentage', $invoice->discount_percentage, ['class' => 'form-control', 'min' => 0, 'max' => '100', 'step' => '1']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('adjustment', 'Adjustment:') !!}
                                {!! Form::number('adjustment', $invoice->adjustment, ['class' => 'form-control', 'step' => '0.01']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('discount_type', 'Discount Type:') !!}
                            {!! Form::select('discount_type', $discountType, $invoice->discount_type, ['class' => 'form-control selectpicker']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('total', 'Total:') !!}
                            {!! Form::text('totalVisible', $invoice->total, ['class' => 'form-control', 'disabled' => true, 'id' => 'totalVisible']) !!}
                            {!! Form::hidden('total_tax', 21, ['id' => 'tax']) !!}
                            {!! Form::hidden('total', $invoice->total, ['id' => 'total']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_note', 'Client Note') !!}
                            {!! Form::textarea('client_note', $invoice->client_note, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('terms', 'Terms of Conditions:') !!}
                            {!! Form::textarea('terms', $invoice->terms, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::hidden('cancel_overdue_reminder', 0) !!}
                            {!! Form::checkbox('cancel_overdue_reminder','1', $invoice->cancel_overdue_reminder, ['class' => 'form-check-input']) !!}
                            {!! Form::label('cancel_overdue_reminder', 'Prevent sending overdue reminders:') !!}
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <br>
                                {!! Form::submit('Update Invoice', ['class' => 'btn btn-primary']) !!}
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

    {{-- Hide unused fields and only show them when needed --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $("#recurringfields").hide();
            $("#recurring").change(function(evt) {
                var selected;
                selected = $(this).val();
                if (selected == 13) {
                    $("#recurringfields").fadeIn();
                } else if (selected != 13) {
                    $("#recurringfields").fadeOut();
                }
            }).change();

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
            $("#totalVisible").val({{$invoice->total}});
            $("#total").val({{$invoice->total}});
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