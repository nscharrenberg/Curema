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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-o"></i> Lead Sources
                        <a href="{{route('admin.leads.sources.create')}}" class="btn btn-primary pull-right"> Create new Lead Source</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($sources) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($sources as $source)
                                <tr>
                                    <td>{{$source->name}}</td>
                                    <td>
                                        <a href="{{route('admin.leads.sources.edit', $source->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($source, ['method' => 'DELETE', 'action' => ['AdminLeadSourceController@destroy', $source->id]]) !!}
                                        {!! Form::hidden('', $source->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any lead sources!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
