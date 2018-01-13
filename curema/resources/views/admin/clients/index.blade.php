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
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-users"></i> Customers
                    <a href="{{route('admin.customer.create')}}" class="btn btn-primary pull-right"> Create new Customer</a>
                </div>
                <div class="card-body card-fullwidth">
                            @if(count($clients) > 0)
                                <table class="table table- table-responsive" width="100%" cellspacing="0">
                                    <thead class="thead-primary">
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
                                                <td><a href="{{route('admin.customer.contact.create', $client->id)}}" class="btn btn-info btn-sm">Add Contactperson</a></td>
                                            @endif
                                            <td>
                                                <a href="{{route('admin.customer.contacts.show', $client->id)}}" class="btn btn-info btn-sm">View Contacts</a>
                                                <a href="{{route('admin.customer.edit', $client->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            @else
                                <h3>No Customers found!</h3>
                            @endif
                </div>
            </div>
        </div>
    </div>
@endsection
