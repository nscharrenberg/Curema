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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.uwv.contacts.create')}}" class="btn btn-primary"> New Contactperson</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        UWV Contacts
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phonenumber</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($contacts)
                            @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$contact->firstname}} {{$contact->lastname}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->phonenumber}}</td>
                                    <td>
                                        <a href="{{route('admin.uwv.contacts.edit', $contact->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($contact, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvContactController@destroy', $contact->id]]) !!}
                                        {!! Form::hidden('', $contact->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
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
