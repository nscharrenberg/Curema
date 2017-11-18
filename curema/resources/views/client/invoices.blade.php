@extends('layouts.client')

@section('content')
    @if(Session::has('created_invoice'))
        <div class="alert alert-success">
            <p>{{session('created_invoice')}}</p>
        </div>
    @endif

    @if(Session::has('updated_invoice'))
        <div class="alert alert-success">
            <p>{{session('updated_invoice')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        My Invoices
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th class="text-center">Sales Agent</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($invoices)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->prefix}}{{$invoice->number}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>{{$invoice->date->toFormattedDateString()}}</td>
                                    <td>{{$invoice->deadline->toFormattedDateString()}}</td>
                                    <td class="text-center">{{$invoice->agent != null ? $invoice->agent->firstname . ' ' . $invoice->agent->lastname : "-"}}</td>
                                    <td>
                                        <a href="{{route('client.invoice.show', $invoice->id)}}" class="btn btn-info btn-xs">View Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
