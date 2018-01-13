@extends('layouts.client')

@section('content')
    @if(Session::has('created_ticket'))
        <div class="alert alert-success">
            <p>{{session('created_ticket')}}</p>
        </div>
    @endif

    @if(Session::has('updated_ticket'))
        <div class="alert alert-success">
            <p>{{session('updated_ticket')}}</p>
        </div>
    @endif
    <div class="container">
        <div class="row">
            @if(count($unsolvedTickets) > 0)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unsolved Tickets
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Content Summary</th>
                                <th>Status</th>
                                <th>Priority</th>
                                <th>Service Employeee</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unsolvedTickets as $ticket)
                                <tr>
                                    <td>{{$ticket->subject}}</td>
                                    <td>{{$ticket->summary()}}</td>
                                    <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                    <td style="color: {{$ticket->priority->color_code}}"><b>{{$ticket->priority->name}}</b></td>
                                    <td>
                                    @if($ticket->agent)
                                       {{$ticket->agent->fullName}}
                                        @else
                                        -
                                    @endif
                                    </td>
                                    <td>
                                        @if($ticket->updated_at != $ticket->created_at)
                                            {{$ticket->updated_at->diffForHumans()}}
                                            @else
                                            -
                                            @endif
                                    </td>
                                    <td><a href="{{route('client.tickets.show', $ticket->id)}}" class="btn btn-warning btn-xs">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($solvedTickets)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Completed Tickets
                            </div>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Content Summary</th>
                                    <th>Status</th>
                                    <th>Service Employee</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($solvedTickets)
                                    @foreach($solvedTickets as $ticket)
                                        <tr>
                                            <td>{{$ticket->subject}}</td>
                                            <td>{{$ticket->summary()}}</td>
                                            <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                            <td>{{$ticket->agent->fullName}}</td>
                                            <td><a href="{{route('client.tickets.show', $ticket->id)}}" class="btn btn-warning btn-xs">View</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
            @endif
        </div>
    </div>
@endsection
