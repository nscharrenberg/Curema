@extends('layouts.app')

@section('content')
    @if(Session::has('created_contract_type'))
        <div class="alert alert-success">
            <p>{{session('created_contract_type')}}</p>
        </div>
    @endif

    @if(Session::has('updated_contract_type'))
        <div class="alert alert-success">
            <p>{{session('updated_contract_type')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_contract_type'))
        <div class="alert alert-success">
            <p>{{session('deleted_contract_type')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-file-text-o "></i> Contract Types
                        <a href="{{route('admin.contracts.types.create')}}" class="btn btn-primary pull-right"> Create new Contract Type</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($types)
                            @foreach($types as $type)
                                <tr>
                                    <td>{{$type->name}}</td>
                                    <td>
                                        <a href="{{route('admin.contracts.types.edit', $type->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($type, ['method' => 'DELETE', 'action' => ['AdminContractTypeController@destroy', $type->id]]) !!}
                                        {!! Form::hidden('', $type->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
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
