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
                    <div class="panel-heading">Clients</div>
                    <br>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminInvoiceController@store']) !!}
                    <div class=" col-md-6">
                        <div class="form-group">
                            {!! Form::label('client_id', 'Customer:') !!}
                            {!! Form::select('client_id', [0 => 'Select a Customer'] + $clients, null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('number', 'Invoice Reference Nr') !!}
                            {!! Form::number('number', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                {!! Form::label('date', 'Invoice Date:') !!}
                                {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'date']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('deadline', 'Due Date:') !!}
                                {!! Form::text('deadline', null, ['class' => 'form-control', 'id' => 'deadline']) !!}
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <div class="form-group">
                            {!! Form::label('allowed_payment_types', 'Payment Method:') !!}
                            {!! Form::select('allowed_payment_types[]', $types, null, ['class' => 'form-control selectpicker', 'multiple' => true]) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                {!! Form::label('currency_id', 'Currency:') !!}
                                {!! Form::select('currency_id', $currencies, null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('agent_id', 'Sales Agent:') !!}
                                {!! Form::select('agent_id', $agents, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('recurring', 'Recurring Invoice?') !!}
                            {!! Form::select('recurring', $recurring, null, ['class' => 'form-control selectpicker', 'id' => 'recurring']) !!}
                        </div>
                        <div id="recurringfields">
                            <div class="form-group">
                                <div class="col-md-6">
                                    {!! Form::number('repeat_every_custom', null, ['class' => 'form-control', 'id' => 'repeat_every_custom']) !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('repeat_type_custom', $customTypes, null, ['class' => 'form-control selectpicker repeat_type_custom', 'id' => 'repeat_type_custom']) !!}
                                </div>
                            </div>

                        </div>
                        <div id="recurringdeadlinefield">
                            <div class="form-group">
                                {!! Form::label('recurring_ends_on', 'Recurring Ends on? (Leave blank if forever') !!}
                                {!! Form::text('recurring_ends_on', null, ['class' => 'form-control', 'id' => 'recurring_ends_on']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('admin_note', 'Admin Notes') !!}
                            {!! Form::textarea('admin_note', null, ['class' => 'form-control', 'rows' => 3]) !!}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group pull-right">
                            {!! Form::label('show_quantity_as', 'Show quantity as: ') !!}
                            <div class=" btn-group" data-toggle="buttons" id="quantity">
                                <label class="btn btn-primary active">
                                    {{ Form::radio('show_quantity_as', 1, true, ['class' => 'radio radio-primary radio-inline']) }} Qty
                                </label>
                                <label class="btn btn-primary">
                                    {{ Form::radio('show_quantity_as', 2, false, ['class' => 'radio radio-primary radio-inline']) }} Hours
                                </label>
                                <label class="btn btn-primary">
                                    {{ Form::radio('show_quantity_as', 3, false, ['class' => 'radio radio-primary radio-inline']) }} Qty/Hour
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

                                <tr class="main" >
                                    <td></td>
                                    <td>
                                        {!! Form::textarea('name[]', null, ['class' => 'form-control', 'rows' => '4', 'id' => 'name']) !!}
                                    </td>
                                    <td>
                                        {!! Form::textarea('description[]', null, ['class' => 'form-control', 'rows' => '4', 'id' => 'description']) !!}
                                    </td>
                                    <td>
                                        {!! Form::number('quantity[]', null, ['class' => 'form-control', 'id' => 'quantity']) !!}
                                        {!! Form::text('unit[]', null, ['class' => 'form-control input-transparent text-right', 'placeholder' => 'Unit', 'id' => 'unit']) !!}
                                    </td>
                                    <td>
                                        {!! Form::number('rate[]', null, ['class' => 'form-control', 'id' => 'rate']) !!}
                                    </td>
                                    <td>
                                        {!! Form::select('tax[]', $taxes, null, ['class' => 'form-control selectpicker', 'multiple' => false, 'id' => 'tax']) !!}
                                    </td>
                                    <td></td>
                                    <td><button id="add-invoice" type="button" class="btn pull-right btn-info"><i class="fa fa-check"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-md-4">
                                {!! Form::label('subtotal', 'Sub Total:') !!}
                                {!! Form::number('subtotal', '0.00', ['class' => 'form-control', 'min' => 0.00, 'step' => '0.5', 'id' => 'subtotal']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('discount_percentage', 'Discount (%):') !!}
                                {!! Form::number('discount_percentage', '0', ['class' => 'form-control', 'min' => 0, 'max' => '100', 'step' => '5']) !!}
                            </div>
                            <div class="col-md-4">
                                {!! Form::label('adjustment', 'Adjustment:') !!}
                                {!! Form::number('adjustment', '0.00', ['class' => 'form-control', 'step' => '0.5']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('discount_type', 'Discount Type:') !!}
                            {!! Form::select('discount_type', $discountType, null, ['class' => 'form-control selectpicker']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('total', 'Total:') !!}
                            {!! Form::text('totalVisible', null, ['class' => 'form-control', 'disabled' => true, 'id' => 'totalVisible']) !!}
                            {!! Form::hidden('total_tax', 21, ['id' => 'tax']) !!}
                            {!! Form::hidden('total', null, ['id' => 'total']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('client_note', 'Client Note') !!}
                            {!! Form::textarea('client_note', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('terms', 'Terms of Conditions:') !!}
                            {!! Form::textarea('terms', null, ['class' => 'form-control', 'rows' => '3']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::hidden('cancel_overdue_reminder', 0) !!}
                            {!! Form::checkbox('cancel_overdue_reminder','1', null, ['class' => 'form-check-input']) !!}
                            {!! Form::label('cancel_overdue_reminder', 'Prevent sending overdue reminders:') !!}
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <br>
                                {!! Form::submit('Add Invoice', ['class' => 'btn btn-primary']) !!}
                            </div>

                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="mydiv"></div>
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
            $("#totalVisible").val('0.00');
            $("#total").val('0.00');
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
    <script>
        $(document).ready(function(e) {
            //TO DO: Use AJAX to submit jQuery/Javascript forms

            //Variables

            var taxesArray = <?php echo json_encode($taxes); ?>;
            var taxes = '';

            $.each(taxesArray, function(index, value) {
                taxes += '<option value="' + index +'" > '+ value +' % </option>';
             });

            var html = "<tr class='main'>" +
                "<td></td>\n" +
                "<td>\n" +
                "<textarea rows=\"4\" id=\"name\" name=\"name[]\" cols=\"50\" class=\"form-control\"></textarea>\n" +
                "</td>\n" +
                "<td>\n" +
                "<textarea rows=\"4\" id=\"description\" name=\"description[]\" cols=\"50\" class=\"form-control\"></textarea>\n" +
                "</td>\n" +
                "<td>\n" +
                "<input id=\"quantity\" name=\"quantity[]\" type=\"number\" class=\"form-control\">\n" +
                "<input placeholder=\"Unit\" id=\"unit\" name=\"unit[]\" type=\"text\" class=\"form-control input-transparent text-right\">\n" +
                "</td>\n" +
                "<td>\n" +
                "<input id=\"rate\" name=\"rate[]\" type=\"number\" class=\"form-control\">\n" +
                "</td>\n" +
                "<td>\n" +
                "<select name=\"tax[]\" id=\"tax\" class=\"form-control selectpicker\" >\n" +
                taxes +
                "</select>" +
                "</td>\n" +
                "<td></td>" +
                "<td><button id=\"remove-invoice\" type=\"button\" class=\"btn pull-right btn-danger\"><i class=\"fa fa-times\"></i></button></td>" +
                "</tr>";

            // Add rows to the form
            $('#add-invoice').click(function() {

                $('#main').append(html);
                $('.selectpicker').selectpicker('refresh');
            });

            // Remove rows from the form
            $('#main').on('click', '#remove-invoice', function(e) {
                        $(this).fadeOut(200, function() {
                            $(this).parents('tr').remove();
                        });

            });


        });

    </script>
@endsection