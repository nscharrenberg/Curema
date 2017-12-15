@extends('layouts.client')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" class="style">
@endsection
@section('content')
    @if(Session::has('estimate_accepted'))
        <div class="alert alert-success">
            <p>{{session('estimate_accepted')}}</p>
        </div>
    @endif
    @if(Session::has('estimate_declined'))
        <div class="alert alert-success">
            <p>{{session('estimate_declined')}}</p>
        </div>
    @endif
    @if($estimate->deadline->toFormattedDateString() != $today->toFormattedDateString())
        @if($estimate->accepted == false && $estimate->response_date != null)
            <div class="alert alert-warning">
                <p>You have declined this Estimate! You can always Accept it, as long as it's within the deadline.</p>
            </div>
            @endif
        @elseif($estimate->response_date == null)
        <div class="alert alert-warning">
            <p>Deadline has expired!</p>
        </div>
        @endif
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="pull-right">
                    @if($estimate->deadline->toFormattedDateString() != $today->toFormattedDateString())
                        @if(!$estimate->accepted && $estimate->response_date == null)
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['ClientEstimateController@accept', $estimate->id]]) !!}
                                        {!! Form::hidden('accepted', true) !!}
                                        {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                                <div class="col-md-6">
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['ClientEstimateController@decline', $estimate->id]]) !!}
                                        {!! Form::hidden('declined', false) !!}
                                        {!! Form::submit('Decline', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @elseif($estimate->accepted == false && $estimate->response_date != null)
                            <div class="row">
                                <div class="col-md-6">
                                    {!! Form::open(['method' => 'PATCH', 'action' => ['ClientEstimateController@accept', $estimate->id]]) !!}
                                    {!! Form::hidden('accepted', true) !!}
                                    {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            @endif
                        @endif

                </div>
                <div class="invoice-title">
                    <h2>Estimate
                        @if($estimate->accepted == true && $estimate->response_date != null)
                            <span class="badge badge-warning" style="background-color: green;">Accepted</span>
                        @elseif($estimate->accepted == false && $estimate->response_date != null)
                            <span class="badge badge-warning" style="background-color: red;">Declined</span>
                        @endif
                    </h2>
                    <h3 class="pull-right">Estimate {{$estimate->prefix}} {{$estimate->number}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
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
                    <div class="col-xs-6 text-right">
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
                    <div class="col-xs-6">

                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Response deadline:</strong><br>
                            {{$estimate->deadline->diffForhumans()}} at <b><u>{{$estimate->deadline->toFormattedDateString()}}</u></b>

                        </address>
                    </div>
                </div>
            </div>
        </div>
        @if($estimate->client_note != null)
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Note to Client</strong></h3>
                        </div>
                        <div class="panel-body">
                            {{$estimate->client_note}}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Estimate summary</strong></h3>
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
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection
