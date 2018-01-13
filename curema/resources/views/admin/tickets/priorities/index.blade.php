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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-ticket"></i> Ticket Priorities
                        <a href="{{route('admin.tickets.priorities.create')}}" class="btn btn-primary pull-right "> Create new Ticket Priority</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($priorities) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
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
                                        <a href="{{route('admin.tickets.priorities.edit', $priority->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($priority, ['method' => 'DELETE', 'action' => ['AdminTicketPriorityController@destroy', $priority->id]]) !!}
                                        {!! Form::hidden('', $priority->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
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
    </div>
@endsection
