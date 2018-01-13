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

    @if(Session::has('created_comment'))
        <div class="alert alert-success">
            <p>{{session('created_comment')}}</p>
        </div>
    @endif
    <div class="container">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-ticket"></i> Ticket:  {{$ticket->subject}}
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
                </div>
                <div class="card-body">
                    <div class="row">
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

                    <div class="row">
                        <div class="col-md-12">
                            <p> {!! $ticket->content !!} </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">
            {!! Form::open(['method' => 'POST', 'action' => ['AdminTicketCommentController@store', $ticket->id], 'class' => 'form-horizontal']) !!}
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-reply"></i> Reply
                    <div class="pull-right">
                        {!! Form::submit('Send Reply', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div class="card-body">

                    {!! Form::hidden('ticket_id', $ticket->id ) !!}
                        <div class="form-group">
                            <div class="col-lg-12">
                                {!! Form::textarea('content_body', null, ['class' => 'form-control', 'rows' => "3"]) !!}
                            </div>
                        </div>



                </div>
            </div>
            {!! Form::close() !!}
        </div>


        <div class="col-md-12">
            @if(count($comments) > 0)
                @foreach($comments as $comment)
                    <div class="card mb-3">
                        <div class="card-header {!! !$comment->isAdmin ? "text-white bg-info" : "bg-light" !!} ">
                            @if($comment->isAdmin)
                                {{$comment->agent->fullName}}
                            @else
                                {{$comment->user->fullName}}
                            @endif
                        </div>
                        <div class="card-body">
                            {!! $comment->content !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection