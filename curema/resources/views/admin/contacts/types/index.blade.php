@extends('layouts.app')

@section('content')
    @if(Session::has('created_contactType'))
        <div class="alert alert-success">
            <p>{{session('created_contactType')}}</p>
        </div>
    @endif

    @if(Session::has('updated_contactType'))
        <div class="alert alert-success">
            <p>{{session('updated_contactType')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_contactType'))
        <div class="alert alert-success">
            <p>{{session('deleted_contactType')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-commenting-o"></i> Contact Types
                        <a href="{{route('admin.contacts.types.create')}}" class="btn btn-primary pull-right"> Create new Contact Type</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($types) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($types as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <a href="{{route('admin.contacts.types.edit', $type->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($type, ['method' => 'DELETE', 'action' => ['AdminClientContactTypeController@destroy', $type->id]]) !!}
                                        {!! Form::hidden('', $type->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>We could not find any Contactmoment types!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
