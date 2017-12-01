@extends('layouts.app')

@section('content')
    @if(Session::has('created_ticket_priority'))
        <div class="alert alert-success">
            <p>{{session('created_ticket_priority')}}</p>
        </div>
    @endif

    @if(Session::has('updated_ticket_priority'))
        <div class="alert alert-success">
            <p>{{session('updated_ticket_priority')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_ticket_priority'))
        <div class="alert alert-success">
            <p>{{session('deleted_ticket_priority')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.tickets.priorities.create')}}" class="btn btn-primary"> New Priority</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ticket Priorities
                    </div>
                    @if(count($priorities) > 0)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($priorities as $priority)
                                <tr>
                                    <td>{{$priority->id}}</td>
                                    <td style="color: {{$priority->color_code}}">{{$priority->name}}</td>
                                    <td>
                                        <a href="{{route('admin.tickets.priorities.edit', $priority->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($priority, ['method' => 'DELETE', 'action' => ['AdminTicketPriorityController@destroy', $priority->id]]) !!}
                                        {!! Form::hidden('', $priority->id) !!}
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
