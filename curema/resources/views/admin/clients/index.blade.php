@extends('layouts.app')

@section('content')
    @if(Session::has('created_client'))
        <div class="alert alert-success">
            <p>{{session('created_client')}}</p>
        </div>
    @endif

    @if(Session::has('updated_client'))
        <div class="alert alert-success">
            <p>{{session('updated_client')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.customer.create')}}" class="btn btn-primary"> Create new Customer</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clients
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Address</th>
                                <th>Zipcode</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Contactperson</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if($clients)
                               @foreach($clients as $client)
                                   <tr>
                                       <td>{{$client->id}}</td>
                                       <td>{{$client->company}}</td>
                                       <td>{{$client->address}}</td>
                                       <td>{{$client->zipcode}}</td>
                                       <td>{{$client->state}}</td>
                                       <td>{{$client->country->name}}</td>
                                       @if($client->user)
                                       <td>{{$client->user->firstname}} {{$client->user->lastname}}</td>
                                           @else
                                           <td><a href="{{route('admin.customer.contact.create', $client->id)}}" class="btn btn-info btn-xs">Add Contactperson</a></td>
                                           @endif
                                       <td>
                                           <a href="{{route('admin.customer.contacts.show', $client->id)}}" class="btn btn-info btn-xs">View Contacts</a>
                                           <a href="{{route('admin.customer.edit', $client->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
