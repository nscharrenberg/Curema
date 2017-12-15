@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Contract: {{$contract->subject}}</h2>
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

