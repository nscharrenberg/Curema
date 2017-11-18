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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.contact.create')}}" class="btn btn-primary"> Create new Contact Moment</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Contact Moments
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Contact #</th>
                            <th>Client</th>
                            <th>Contact Person</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($contacts)
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->id}}</td>
                                    <td>{{$contact->client->company}}</td>
                                    <td>{{$contact->contact->firstname}} {{$contact->contact->lastnmae}}</td>
                                    <td>{{$contact->date->toFormattedDateString()}}</td>
                                    <td>{{$contact->start_time}}</td>
                                    <td>{{$contact->end_time}}</td>
                                    <td>{{$contact->notes}}</td>
                                    <td>
                                        <a href="{{route('admin.contact.edit', [$contact->client->id, $contact->id])}}" class="btn btn-warning btn-xs">Edit</a>
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
