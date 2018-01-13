@extends('layouts.app')

@section('content')
    @if(Session::has('created_clientContact'))
        <div class="alert alert-success">
            <p>{{session('created_clientContact')}}</p>
        </div>
    @endif

    @if(Session::has('updated_clientContact'))
        <div class="alert alert-success">
            <p>{{session('updated_clientContact')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-commenting-o"></i> Contactmoments with {{$client->company}}
                        <a href="{{route('admin.contact.create', $client->id)}}" class="btn btn-primary pull-right"> Create new Contact Moment</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($contacts) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Client</th>
                            <th>Contact Person</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Notes</th>
                            <th>Status</th>
                            <th>Werknemer</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->client->company}}</td>
                                    <td>{{$contact->contact->firstname}} {{$contact->contact->lastnmae}}</td>
                                    <td>{{$contact->date->toFormattedDateString()}}</td>
                                    <td>{{$contact->start_time}}</td>
                                    <td>{{$contact->end_time}}</td>
                                    <td>{{$contact->notes}}</td>
                                    <td>{{$contact->type->name}}</td>
                                    <td>{{$contact->employee->FullName}}</td>
                                    <td>
                                        <a href="{{route('admin.contact.edit', [$contact->client->id, $contact->id])}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                        <h3>There has not yet been any contact with this customer.</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
