@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($unassignedTickets) > 0)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Unassigned Tickets
                        </div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Content Summary</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($unassignedTickets as $ticket)
                                <tr>
                                    <td>{{$ticket->subject}}</td>
                                    <td>{{$ticket->summary()}}</td>
                                    <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                    <td>{{$ticket->user->fullName}}</td>
                                    <td><a href="{{route('admin.tickets.show', $ticket->id)}}" class="btn btn-warning btn-xs">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if($ticketsSection)
                @foreach($ticketsSection as $key => $tickets)
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{{$property = \App\TicketPriority::getByRank($key+1)->name}}} Tickets
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Subject</th>
                            <th>Content Summary</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                                    @if($tickets)
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{$ticket->subject}}</td>
                                                <td>{{$ticket->summary()}}</td>
                                                <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                                <td>{{$ticket->user->fullName}}</td>
                                                <td><a href="{{route('admin.tickets.show', $ticket->id)}}" class="btn btn-warning btn-xs">View</a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                        </tbody>
                    </table>
                </div>
            </div>
                @endforeach
            @endif

                @if(count($completedTickets) > 0)
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
                                    <th>Customer</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($completedTickets as $ticket)
                                    <tr>
                                        <td>{{$ticket->subject}}</td>
                                        <td>{{$ticket->summary()}}</td>
                                        <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                        <td>{{$ticket->user->fullName}}</td>
                                        <td><a href="{{route('admin.tickets.show', $ticket->id)}}" class="btn btn-warning btn-xs">View</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
