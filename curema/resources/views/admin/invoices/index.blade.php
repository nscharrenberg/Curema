@extends('layouts.app')

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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.invoice.create')}}" class="btn btn-primary"> Create new Invoice</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Invoice #</th>
                            <th>Amount</th>
                            <th>Total Tax</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($invoices)
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$invoice->prefix}}{{$invoice->number}}</td>
                                    <td>{{$invoice->total}}</td>
                                    <td>{{$invoice->total_tax}}</td>
                                    <td>{{$invoice->date}}</td>
                                    <td>{{$invoice->deadline}}</td>
                                    <td>{{$invoice->client->company}}</td>
                                    <td>{{$invoice->status}}</td>
                                    <td>
                                        <a href="{{route('admin.invoice.show', $invoice->id)}}" class="btn btn-info btn-xs">View Invoice</a>
                                        <a href="{{route('admin.invoice.edit', $invoice->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
