@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        My Estimates
                    </div>
                    @if(count($estimates) > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Estimate #</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th class="text-center">Sales Agent</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($estimates as $estimate)
                                <tr>
                                    <td>{{$estimate->prefix}}{{$estimate->number}}</td>
                                    <td>{{$estimate->amount}}</td>
                                    <td>{{$estimate->date->toFormattedDateString()}}</td>
                                    <td>{{$estimate->deadline->toFormattedDateString()}}</td>
                                    <td class="text-center">{{$estimate->agent != null ? $estimate->agent->firstname . ' ' . $estimate->agent->lastname : "-"}}</td>
                                    <td>
                                        <a href="{{route('client.estimates.show', $estimate->id)}}" class="btn btn-info btn-xs">View Estimate</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>There are no estimates for you yet!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
