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
            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.contacts.types.create')}}" class="btn btn-primary"> New Types</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Types
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($types)
                            @foreach($types as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <a href="{{route('admin.contacts.types.edit', $type->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($type, ['method' => 'DELETE', 'action' => ['AdminClientContactTypeController@destroy', $type->id]]) !!}
                                        {!! Form::hidden('', $type->id) !!}
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
