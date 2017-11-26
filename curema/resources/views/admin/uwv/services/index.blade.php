@extends('layouts.app')

@section('content')
    @if(Session::has('created_uwv_service'))
        <div class="alert alert-success">
            <p>{{session('created_uwv_service')}}</p>
        </div>
    @endif

    @if(Session::has('updated_uwv_service'))
        <div class="alert alert-success">
            <p>{{session('updated_uwv_service')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_uwv_service'))
        <div class="alert alert-success">
            <p>{{session('deleted_uwv_service')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.uwv.services.create')}}" class="btn btn-primary"> New Service</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Services
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($services)
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>
                                        <a href="{{route('admin.uwv.services.edit', $service->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($service, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvServiceController@destroy', $service->id]]) !!}
                                        {!! Form::hidden('', $service->id) !!}
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
