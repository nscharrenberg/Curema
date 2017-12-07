@extends('layouts.app')

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

    @if(Session::has('deleted_ticket'))
        <div class="alert alert-success">
            <p>{{session('deleted_ticket')}}</p>
        </div>
    @endif

    @if(Session::has('updated_completion'))
        <div class="alert alert-success">
            <p>{{session('updated_completion')}}</p>
        </div>
    @endif

    @if(Session::has('updated_claimed'))
        <div class="alert alert-success">
            <p>{{session('updated_claimed')}}</p>
        </div>
    @endif
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="content">
                    <h2 class="header">
                        {{$ticket->subject}}
                        <span class="pull-right">
                            <div class="col-md-5">
                                @if(!$ticket->complete)
                                    {!! Form::model($ticket, ['method' => 'PATCH', 'action' => ['AdminTicketController@status', $ticket->id]]) !!}
                                    {!! Form::hidden('complete', true) !!}
                                    {!! Form::submit('Mark as Complete', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                @elseif($ticket->complete)
                                    {!! Form::model($ticket, ['method' => 'PATCH', 'action' => ['AdminTicketController@status', $ticket->id]]) !!}
                                    {!! Form::hidden('complete', false) !!}
                                    {!! Form::submit('Reopen Ticket', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </span>
                    </h2>
                    <div class="panel well well-sm">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <p><strong>Customer: </strong> {{$ticket->user->fullName}}</p>
                                    <p><strong>Status: </strong><span style="color: {{ $ticket->status->color_code }}"> {{$ticket->status->name}} </span></p>
                                    <p><strong>Priority: </strong><span style="color: {{ $ticket->priority->color_code }}"> {{$ticket->priority->name}} </span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Responsibility of: </strong>
                                        @if($ticket->agent)
                                            {{$ticket->agent->fullName}}
                                        @else
                                            {!! Form::model($ticket, ['method' => 'PATCH', 'action' => ['AdminTicketController@claim', $ticket->id]]) !!}
                                            {!! Form::submit('Claim Ticket', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </p>
                                    <p><strong>Category: </strong> {{$ticket->category->name}}</p>
                                    <p><strong>Created: </strong> {{$ticket->created_at->diffForHumans()}}</p>
                                    @if($ticket->created_at != $ticket->updated_at)
                                    <p><strong>Last Updated: </strong> {{$ticket->updated_at->diffForHumans()}}</p>
                                        @else
                                        <p><strong>Last Updated: </strong> Never</p>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p> {!! $ticket->content !!} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection