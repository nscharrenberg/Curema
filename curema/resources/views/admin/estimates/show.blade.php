@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-building-o"></i> Estimate # {{$estimate->prefix}}{{$estimate->number}}
                    </div>
                    <div class="card-body">

                <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Billed To:</strong><br>
                                @if($estimate->client->billing_address!= null && $estimate->client->billing_zipcode != null && $estimate->client->billing_state != null && $estimate->client->billing_city != null && $estimate->client->billing_country_id != null)
                                    {{$estimate->client->company}}<br>
                                    {{$estimate->client->billing_address}}<br>
                                    {{$estimate->client->billing_zipcode}} {{$estimate->client->billing_city}}<br>
                                    {{$estimate->client->billing_state}}, {{$estimate->client->billing_country->name}}

                                @else
                                    {{$estimate->client->company}}<br>
                                    {{$estimate->client->address}}<br>
                                    {{$estimate->client->zipcode}} {{$estimate->client->city}}<br>
                                    {{$estimate->client->state}}, {{$estimate->client->country->name}}
                                @endif
                            </address>
                        </div>
                        <div class="col-md-6 text-right">
                            <address>
                                <strong>Shipped To:</strong><br>
                                @if($estimate->client->shipping_address!= null && $estimate->client->shipping_zipcode != null && $estimate->client->shipping_state != null && $estimate->client->shipping_city != null && $estimate->client->shipping_country_id != null)
                                    {{$estimate->client->company}}<br>
                                    {{$estimate->client->shipping_address}}<br>
                                    {{$estimate->client->shipping_zipcode}} {{$estimate->client->shipping_city}}<br>
                                    {{$estimate->client->shipping_state}}, {{$estimate->client->shipping_country->name}}

                                @else
                                    {{$estimate->client->company}}<br>
                                    {{$estimate->client->address}}<br>
                                    {{$estimate->client->zipcode}} {{$estimate->client->city}}<br>
                                    {{$estimate->client->state}}, {{$estimate->client->country->name}}
                                @endif

                            </address>
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6 text-right pull-right">
                            <address>
                                <strong>Estimate Date:</strong><br>
                                {{$estimate->date->toFormattedDateString()}}
                            </address>

                            <address>
                                <strong>Approval Deadline:</strong><br>
                                {{$estimate->deadline->diffForhumans()}} at <b><u>{{$estimate->deadline->toFormattedDateString()}}</u></b>
                            </address>
                        </div>
                    </div>
                </div>
                        <hr>
                        <div class="row">
                            <h3 class="panel-title"><strong>Estimate Summary</strong></h3>
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
                                @foreach($estimate->items as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td class="text-center">{{$estimate->currency->symbol}}{{$item->rate}}</td>
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
                                    <td class="thick-line text-right">{{$estimate->currency->symbol}}{{$estimate->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="thick-line text-center"><strong>Adjustment</strong></td>
                                    <td class="thick-line text-right">{{$estimate->currency->symbol}}{{$estimate->adjustment}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">{{$estimate->currency->symbol}}{{$estimate->total}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>


    </div>
@endsection

