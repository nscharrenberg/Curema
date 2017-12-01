@extends('layouts.app')

@section('content')
    @if(Session::has('created_ticket_status'))
        <div class="alert alert-success">
            <p>{{session('created_ticket_status')}}</p>
        </div>
    @endif

    @if(Session::has('updated_ticket_status'))
        <div class="alert alert-success">
            <p>{{session('updated_ticket_status')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_ticket_status'))
        <div class="alert alert-success">
            <p>{{session('deleted_ticket_status')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.tickets.statuses.create')}}" class="btn btn-primary"> New Status</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ticket Status
                    </div>
                    @if(count($statuses) > 0)
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{$status->id}}</td>
                                    <td style="color: {{$status->color_code}}">{{$status->name}}</td>
                                    <td>
                                        <a href="{{route('admin.tickets.statuses.edit', $status->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($status, ['method' => 'DELETE', 'action' => ['AdminTicketStatusController@destroy', $status->id]]) !!}
                                        {!! Form::hidden('', $status->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    @else
                        <h3>No Ticket Priorities have been found!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
