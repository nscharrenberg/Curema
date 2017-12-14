@extends('layouts.app')

@section('content')
    @if(Session::has('created_expense'))
        <div class="alert alert-success">
            <p>{{session('created_expense')}}</p>
        </div>
    @endif

    @if(Session::has('updated_expense'))
        <div class="alert alert-success">
            <p>{{session('updated_expense')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.expenses.create')}}" class="btn btn-primary"> Add Expense</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoices
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Customer</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($expenses)
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->prefix}}{{$expense->number}}</td>
                                    <td>{{$expense->name}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->category->name}}</td>
                                    <td>{{$expense->client ? $expense->client->company : "-"}}</td>
                                    <td>
                                        <a href="{{route('admin.expenses.show', $expense->id)}}" class="btn btn-info btn-xs">View Expense</a>
                                        <a href="{{route('admin.expenses.edit', $expense->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
