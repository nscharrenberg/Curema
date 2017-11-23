@extends('layouts.app')

@section('content')
    @if(Session::has('created_lead'))
        <div class="alert alert-success">
            <p>{{session('created_lead')}}</p>
        </div>
    @endif

    @if(Session::has('updated_lead'))
        <div class="alert alert-success">
            <p>{{session('updated_lead')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_lead'))
        <div class="alert alert-success">
            <p>{{session('deleted_lead')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.leads.create')}}" class="btn btn-primary"> New Lead</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Leads
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($leads)
                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{$lead->name}}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->company}}</td>
                                    <td>
                                        <a href="{{route('admin.leads.edit', $lead->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($lead, ['method' => 'DELETE', 'action' => ['AdminLeadController@destroy', $lead->id]]) !!}
                                        {!! Form::hidden('', $lead->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
