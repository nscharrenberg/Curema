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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.uwv.processes.create')}}" class="btn btn-primary"> New Contactperson</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        UWV Contacts
                    </div>
                    <table class="table table-hover">
                        <thead>
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
                        @if($processes)
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
                                        <a href="{{route('admin.uwv.processes.edit', $process->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($process, ['method' => 'DELETE', 'action' => ['Addons\AdminUwvProcessController@destroy', $process->id]]) !!}
                                        {!! Form::hidden('', $process->id) !!}
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
