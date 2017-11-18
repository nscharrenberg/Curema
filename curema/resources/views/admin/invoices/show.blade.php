@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Invoice</h2><h3 class="pull-right">Order {{$invoice->prefix}} {{$invoice->number}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Billed To:</strong><br>
                            @if($invoice->client->billing_address!= null && $invoice->client->billing_zipcode != null && $invoice->client->billing_state != null && $invoice->client->billing_city != null && $invoice->client->billing_country_id != null)
                                {{$invoice->client->company}}<br>
                                {{$invoice->client->billing_address}}<br>
                                {{$invoice->client->billing_zipcode}} {{$invoice->client->billing_city}}<br>
                                {{$invoice->client->billing_state}}, {{$invoice->client->billing_country->name}}

                            @else
                                {{$invoice->client->company}}<br>
                                {{$invoice->client->address}}<br>
                                {{$invoice->client->zipcode}} {{$invoice->client->city}}<br>
                                {{$invoice->client->state}}, {{$invoice->client->country->name}}
                            @endif
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Shipped To:</strong><br>
                            @if($invoice->client->shipping_address!= null && $invoice->client->shipping_zipcode != null && $invoice->client->shipping_state != null && $invoice->client->shipping_city != null && $invoice->client->shipping_country_id != null)
                                {{$invoice->client->company}}<br>
                                {{$invoice->client->shipping_address}}<br>
                                {{$invoice->client->shipping_zipcode}} {{$invoice->client->shipping_city}}<br>
                                {{$invoice->client->shipping_state}}, {{$invoice->client->shipping_country->name}}

                                @else
                                {{$invoice->client->company}}<br>
                                {{$invoice->client->address}}<br>
                                {{$invoice->client->zipcode}} {{$invoice->client->city}}<br>
                                {{$invoice->client->state}}, {{$invoice->client->country->name}}
                                @endif

                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Allowed Payment Methods:</strong><br>
                            @if(is_array($payTypesArray))
                                @foreach($payTypesArray as $payType)
                                    {{$payType->name}} <br>
                                    @endforeach
                                @endif
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Order Date:</strong><br>
                            {{$invoice->date->toFormattedDateString()}}
                        </address>

                        <address>
                            <strong>Payment Deadline:</strong><br>
                            {{$invoice->deadline->diffForhumans()}} at <b><u>{{$invoice->deadline->toFormattedDateString()}}</u></b>

                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Order summary</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td><strong>Item</strong></td>
                                    <td><strong>Name</strong></td>
                                    <td><strong>Description</strong></td>
                                    <td class="text-center"><strong>Rate</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-center"><strong>Tax</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoice->items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td class="text-center">{{$invoice->currency->symbol}}{{$item->rate}}</td>
                                        <td class="text-center">{{$item->quantity}} {{$item->unit}}</td>
                                        <td class="text-center">
                                                    @foreach($item->tax as $tax)
                                                        {{$tax->rate}}%
                                                        @endforeach
                                            </td>
                                        <td class="text-right">{{$item->rate * $item->quantity}}</td>
                                    </tr>
                                    @endforeach

                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">{{$invoice->currency->symbol}}{{$invoice->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="thick-line text-center"><strong>Adjustment</strong></td>
                                    <td class="thick-line text-right">{{$invoice->currency->symbol}}{{$invoice->adjustment}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">{{$invoice->currency->symbol}}{{$invoice->total}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

