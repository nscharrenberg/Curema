@extends('layouts.app')

@section('content')
    @if(Session::has('created_contract'))
        <div class="alert alert-success">
            <p>{{session('created_contract')}}</p>
        </div>
    @endif

    @if(Session::has('updated_contract'))
        <div class="alert alert-success">
            <p>{{session('updated_contract')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_contract'))
        <div class="alert alert-success">
            <p>{{session('deleted_contract')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-file-text-o"></i> Contracts
                        <a href="{{route('admin.contracts.create')}}" class="btn btn-primary pull-right"> Create new Contract Type</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Customer</th>
                            <th>Contract Type</th>
                            <th>Value</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($contracts)
                            @foreach($contracts as $contract)
                                <tr>
                                    <td>{{$contract->id}}</td>
                                    <td>{{$contract->subject}}</td>
                                    <td>{{$contract->client->company}}</td>
                                    <td>{{$contract->type->name}}</td>
                                    <td>{{$contract->currency->symbol}} {{$contract->value}}</td>
                                    <td>{{$contract->start_date->toFormattedDateString()}}</td>
                                    <td>{{$contract->end_date->toFormattedDateString()}}</td>
                                    <td>
                                        <a href="{{route('admin.contracts.show', $contract->id)}}" class="btn btn-info btn-sm">View</a>
                                        <a href="{{route('admin.contracts.edit', $contract->id)}}" class="btn btn-warning btn-sm">Edit</a>
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
    </div>
@endsection
