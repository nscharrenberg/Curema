@extends('layouts.app')

@section('content')
    @if(Session::has('created_uwv_process'))
        <div class="alert alert-success">
            <p>{{session('created_uwv_process')}}</p>
        </div>
    @endif

    @if(Session::has('updated_uwv_process'))
        <div class="alert alert-success">
            <p>{{session('updated_uwv_process')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_uwv_process'))
        <div class="alert alert-success">
            <p>{{session('deleted_uwv_process')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-recycle"></i> UWV Processes
                        <a href="{{route('admin.uwv.processes.create')}}" class="btn btn-primary pull-right"> Create new UWV Process</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($processes) > 0)
                    <table class="table table-hover table-responsive">
                        <thead class="thead-primary">
                        <tr>
                            <th>Ordernr</th>
                            <th>Client</th>
                            <th>Assignment date</th>
                            <th>Process deadline</th>
                            <th>Service status</th>
                            <th>UWV Contacts</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($processes as $process)
                                <tr>
                                    <td>{{$process->ordernr}}</td>
                                    <td>{{$process->client->fullname}}</td>
                                    <td>{{$process->start_date->toFormattedDateString()}}
                                    <td>{{$process->end_date->diffForHumans()}}</td>
                                    <td>{{$process->service->name}}</td>
                                    <td>
                                        @foreach($process->contacts as $contact)
                                            {{$contact->fullname}},
                                            @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('admin.uwv.processes.edit', $process->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($process, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvProcessController@destroy', $process->id]]) !!}
                                        {!! Form::hidden('', $process->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any UWV Process!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
