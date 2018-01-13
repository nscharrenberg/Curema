@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        My Estimates
                    </div>
                    @if(count($contracts) > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Contract Type</th>
                            <th>Value</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($contracts as $contract)
                                <tr>
                                    <td>{{$contract->id}}</td>
                                    <td>{{$contract->subject}}</td>
                                    <td>{{$contract->type->name}}</td>
                                    <td>{{$contract->currency->symbol}} {{$contract->value}}</td>
                                    <td>{{$contract->start_date->toFormattedDateString()}}</td>
                                    <td>{{$contract->end_date->toFormattedDateString()}}</td>
                                    <td style="color: {{$contract->accepted == true && $contract->response_date != null ? "green" : ($contract->accepted == false && $contract->response_date ? "red" : "") }}">{{$contract->accepted == true && $contract->response_date != null ? "Accepted" : ($contract->accepted == false && $contract->response_date ? "Declined" : "Awaiting Response") }}</td>
                                    <td>
                                        <a href="{{route('client.contracts.show', $contract->id)}}" class="btn btn-info btn-xs">View</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>There are no contracts for you yet!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
