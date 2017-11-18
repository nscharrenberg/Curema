@extends('layouts.app')

@section('content')

    @if(Session::has('created_contact'))
        <div class="alert alert-success">
            <p>{{session('created_contact')}}</p>
        </div>
    @endif

    @if(Session::has('updated_contact'))
        <div class="alert alert-success">
            <p>{{session('updated_contact')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.customer.contact.create', $client->id)}}" class="btn btn-primary"> Create new Contact for {{$client->company}}</a></div>
            </div>
            <div class="col1-md12 pull-left">
                <div class="panel-heading"><a href="{{route('admin.contact.show', $client->id)}}" class="btn btn-warning">View Contact Moment</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$client->company}}
                    </div>
                    @if(count($contacts) > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Activated</th>
                                <th>Primary Contact</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{$contact->id}}</td>
                                            <td>{{$contact->firstname}}</td>
                                            <td>{{$contact->lastname}}</td>
                                            <td>{{$contact->active ? "Yes" : "No"}}</td>
                                            @if($contact->id == $client->user->id)
                                                <td>Yes</td>
                                                @else
                                                <td>No</td>
                                                @endif
                                            <td>
                                                <a href="{{route('admin.customer.contact.edit', [$client->id, $contact->id])}}" class="btn btn-warning btn-xs">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <h1>There are no Contactpersons yet!</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
