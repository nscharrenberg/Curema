@extends('layouts.app')

@section('content')
    @if(Session::has('created_estimate'))
        <div class="alert alert-success">
            <p>{{session('created_estimate')}}</p>
        </div>
    @endif

    @if(Session::has('updated_estimate'))
        <div class="alert alert-success">
            <p>{{session('updated_estimate')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.estimates.create')}}" class="btn btn-primary"> Create new Estimate</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Estimates
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Estimate #</th>
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
                        @if($estimates)
                            @foreach($estimates as $estimate)
                                <tr>
                                    <td>{{$estimate->prefix}}{{$estimate->number}}</td>
                                    <td>{{$estimate->total}}</td>
                                    <td>{{$estimate->total_tax}}</td>
                                    <td>{{$estimate->date}}</td>
                                    <td>{{$estimate->deadline}}</td>
                                    <td>{{$estimate->client->company}}</td>
                                    <td>{{$estimate->status}}</td>
                                    <td>
                                        <a href="{{route('admin.estimates.show', $estimate->id)}}" class="btn btn-info btn-xs">View Estimate</a>
                                        <a href="{{route('admin.estimates.edit', $estimate->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
