@extends('layouts.client')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" class="style">
@endsection
@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Ticket</div>
                    {!! Form::open(['method' => 'PATCH', 'action' => ['ClientTicketController@update', $ticket->id]]) !!}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('status_id', 'Status:') !!}
                                {!! Form::select('status_id', $statuses, $ticket->status_id, ['class' => 'form-control selectpicker']) !!}
                            </div>
                             <div class="col-md-6">
                                {!! Form::label('priority_id', 'Priority:') !!}
                                {!! Form::select('priority_id', $priorities, $ticket->priority_id, ['class' => 'form-control selectpicker']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('subject', 'Subject:') !!}
                        {!! Form::text('subject', $ticket->subject, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('content_body', 'Content:') !!}
                        {!! Form::textarea('content_body', $ticket->content, ['class' => 'form-control', 'step' => '0.01']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update Ticket', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
@endsection