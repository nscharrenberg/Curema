@extends('layouts.app')

@section('content')
    @if(Session::has('created_paymenttype'))
        <div class="alert alert-success">
            <p>{{session('created_paymenttype')}}</p>
        </div>
    @endif

    @if(Session::has('updated_paymenttype'))
        <div class="alert alert-success">
            <p>{{session('updated_paymenttype')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.payments.create')}}" class="btn btn-primary"> New Payment Method</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Clients
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Show on PDF</th>
                            <th>Selected by default</th>
                            <th>Activated</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($types)
                            @foreach($types as $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>{{$type->description}}</td>
                                    <td>{{$type->show_on_pdf ? "Yes" : "No"}}</td>
                                    <td>{{$type->default ? "Yes" : "No"}}</td>
                                    <td>{{$type->active ? "Yes" : "No"}}</td>
                                    <td>
                                        <a href="{{route('admin.payments.edit', $type->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
