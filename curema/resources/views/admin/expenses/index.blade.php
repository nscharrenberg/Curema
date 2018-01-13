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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-credit-card "></i> Expenses
                        <a href="{{route('admin.expenses.create')}}" class="btn btn-primary pull-right"> Create new Expense</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($expenses) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Customer</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->prefix}}{{$expense->number}}</td>
                                    <td>{{$expense->name}}</td>
                                    <td>{{$expense->amount}}</td>
                                    <td>{{$expense->category->name}}</td>
                                    <td>{{$expense->client ? $expense->client->company : "-"}}</td>
                                    <td>
                                        <a href="{{route('admin.expenses.edit', $expense->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any Expenses!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
