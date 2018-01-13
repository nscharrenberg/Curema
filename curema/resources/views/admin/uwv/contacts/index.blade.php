@extends('layouts.app')

@section('content')
    @if(Session::has('created_uwv_contact'))
        <div class="alert alert-success">
            <p>{{session('created_uwv_contact')}}</p>
        </div>
    @endif

    @if(Session::has('updated_uwv_contact'))
        <div class="alert alert-success">
            <p>{{session('updated_uwv_contact')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_uwv_contact'))
        <div class="alert alert-success">
            <p>{{session('deleted_uwv_contact')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-md"></i> UWV Contact persons
                        <a href="{{route('admin.uwv.contacts.create')}}" class="btn btn-primary pull-right"> Create new UWV Contact person</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($contacts) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phonenumber</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->firstname}} {{$contact->lastname}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phonenumber}}</td>
                                    <td>
                                        <a href="{{route('admin.uwv.contacts.edit', $contact->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($contact, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvContactController@destroy', $contact->id]]) !!}
                                        {!! Form::hidden('', $contact->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any UWV Contact!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
