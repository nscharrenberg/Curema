@extends('layouts.app')

@section('content')
    @if(Session::has('created_leadSource'))
        <div class="alert alert-success">
            <p>{{session('created_leadSource')}}</p>
        </div>
    @endif

    @if(Session::has('updated_leadSource'))
        <div class="alert alert-success">
            <p>{{session('updated_leadSource')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_leadSource'))
        <div class="alert alert-success">
            <p>{{session('deleted_leadSource')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.leads.sources.create')}}" class="btn btn-primary"> New Lead Source</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Taxes
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($sources)
                            @foreach($sources as $source)
                                <tr>
                                    <td>{{$source->name}}</td>
                                    <td>
                                        <a href="{{route('admin.leads.sources.edit', $source->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($source, ['method' => 'DELETE', 'action' => ['AdminLeadSourceController@destroy', $source->id]]) !!}
                                        {!! Form::hidden('', $source->id) !!}
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
