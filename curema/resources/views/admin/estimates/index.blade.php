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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-calculator"></i> Estimates
                        <a href="{{route('admin.estimates.create')}}" class="btn btn-primary pull-right"> Create new Estimate</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($estimates) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
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
                                        <a href="{{route('admin.estimates.show', $estimate->id)}}" class="btn btn-info btn-sm">View Estimate</a>
                                        <a href="{{route('admin.estimates.edit', $estimate->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>No Estimates found!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
