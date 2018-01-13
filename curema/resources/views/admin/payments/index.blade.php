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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-credit-card-alt"></i> Payment Methods
                        <a href="{{route('admin.payments.create')}}" class="btn btn-primary pull-right"> Create new Department</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($types) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
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

                            @foreach($types as $type)
                                <tr>
                                    <td>{{$type->id}}</td>
                                    <td>{{$type->name}}</td>
                                    <td>{{$type->description}}</td>
                                    <td>{{$type->show_on_pdf ? "Yes" : "No"}}</td>
                                    <td>{{$type->default ? "Yes" : "No"}}</td>
                                    <td>{{$type->active ? "Yes" : "No"}}</td>
                                    <td>
                                        <a href="{{route('admin.payments.edit', $type->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any Payment Methods!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
