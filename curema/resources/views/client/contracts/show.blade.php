@extends('layouts.client')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                @if(!$contract->accepted && $contract->response_date == null)
                    <div class="pull-right">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::open(['method' => 'PATCH', 'action' => ['ClientContractController@accept', $contract->id]]) !!}
                                {!! Form::hidden('accepted', true) !!}
                                {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::open(['method' => 'PATCH', 'action' => ['ClientContractController@decline', $contract->id]]) !!}
                                {!! Form::hidden('declined', false) !!}
                                    {!! Form::submit('Decline', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                @endif
                <div class="invoice-title">
                    <h2>
                        Contract: {{$contract->subject}}
                        @if($contract->accepted == true && $contract->response_date != null)
                            <span class="badge badge-warning" style="background-color: green;">Accepted</span>
                        @elseif($contract->accepted == false && $contract->response_date != null)
                            <span class="badge badge-warning" style="background-color: red;">Declined</span>
                        @endif
                    </h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Start Date:</strong><br>
                            {{$contract->start_date->toFormattedDateString()}}
                        </address>
                    </div>
                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Ends in:</strong><br>
                            {{$contract->end_date->diffForhumans()}} at <b><u>{{$contract->end_date->toFormattedDateString()}}</u></b>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Content</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            {{$contract->content}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

