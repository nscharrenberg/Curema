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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-file"></i> Invoices
                        <a href="{{route('admin.invoice.create')}}" class="btn btn-primary pull-right"> Create new Invoice</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($invoices) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
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
                                        <a href="{{route('admin.invoice.show', $invoice->id)}}" class="btn btn-info btn-sm">View Invoice</a>
                                        <a href="{{route('admin.invoice.edit', $invoice->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find Invoices!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
