@extends('layouts.app')

@section('content')
    @if(Session::has('created_leadStatus'))
        <div class="alert alert-success">
            <p>{{session('created_leadStatus')}}</p>
        </div>
    @endif

    @if(Session::has('updated_leadStatus'))
        <div class="alert alert-success">
            <p>{{session('updated_leadStatus')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_leadStatus'))
        <div class="alert alert-success">
            <p>{{session('deleted_leadStatus')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.leads.status.create')}}" class="btn btn-primary"> New Lead Status</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Taxes
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Order</th>
                            <th>Color</th>
                            <th>Default</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($statusses)
                            @foreach($statusses as $status)
                                <tr>
                                    <td>{{$status->name}}</td>
                                    <td>{{$status->order}}</td>
                                    <td><div class="colorbox" style="background-color: {{$status->color_code}}; height: 10px; width: 10px; display: inline-block"></div><span style="margin-left: 5px; vertical-align: middle">{{$status->color_code}}</span> </td>
                                    <td>{{$status->default == 1 ? "Yes" : "No"}}</td>
                                    <td>
                                        <a href="{{route('admin.leads.status.edit', $status->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($status, ['method' => 'DELETE', 'action' => ['AdminLeadStatusController@destroy', $status->id]]) !!}
                                        {!! Form::hidden('', $status->id) !!}
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
