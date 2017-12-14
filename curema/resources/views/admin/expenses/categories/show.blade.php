@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Expenses for {{$category->name}}
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
                        @if($category->expenses)
                            @foreach($category->expenses as $expense)
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
