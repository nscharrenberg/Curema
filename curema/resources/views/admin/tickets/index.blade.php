@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(count($unassignedTickets) > 0)
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-ticket"></i> Unassigned Tickets
                        </div>
                        <div class="card-body card-fullwidth">
                        <table class="table table-hover">
                            <thead class="thead-danger">
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
                                    <td><a href="{{route('admin.tickets.show', $ticket->id)}}" class="btn btn-warning btn-sm">View</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            @endif

            @if(count($priorities) > 0)
                @foreach($priorities as $prio)
                    @php($tickets = App\Ticket::rank($prio))
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">

                            <i class="fa fa-ticket"></i> {{$prio->name}} Ticket
                    </div>
                    <div class="card-body card-fullwidth">
                        @if(count($tickets) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Subject</th>
                            <th>Content Summary</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{$ticket->subject}}</td>
                                                <td>{{$ticket->summary()}}</td>
                                                <td style="color: {{$ticket->status->color_code}}"><b>{{$ticket->status->name}}</b></td>
                                                <td>{{$ticket->user->fullName}}</td>
                                                <td><a href="{{route('admin.tickets.show', $ticket->id)}}" class="btn btn-warning btn-sm">View</a></td>
                                            </tr>
                                        @endforeach

                        </tbody>
                    </table>
                        @else
                            <h3>There are no Tickets for you.</h3>
                        @endif
                    </div>
                </div>
            </div>
                @endforeach
            @endif

                @if(count($completedTickets) > 0)
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <i class="fa fa-ticket"></i> Completed Tickets
                            </div>
                            <div class="card-body card-fullwidth">
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
                    </div>
                @endif
        </div>
    </div>
@endsection
