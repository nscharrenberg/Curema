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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-exclamation-triangle "></i> UWV Services
                        <a href="{{route('admin.uwv.services.create')}}" class="btn btn-primary pull-right"> Create new UWV Service</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($services) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>
                                        <a href="{{route('admin.uwv.services.edit', $service->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($service, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvServiceController@destroy', $service->id]]) !!}
                                        {!! Form::hidden('', $service->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any UWV Service!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
