@extends('layouts.app')

@section('content')
    @if(Session::has('created_expense_category'))
        <div class="alert alert-success">
            <p>{{session('created_expense_category')}}</p>
        </div>
    @endif

    @if(Session::has('updated_expense_category'))
        <div class="alert alert-success">
            <p>{{session('updated_expense_category')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_expense_category'))
        <div class="alert alert-success">
            <p>{{session('deleted_expense_category')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-credit-card"></i> Expense Category
                        <a href="{{route('admin.expenses.categories.create')}}" class="btn btn-primary pull-right"> Create new Expense Category</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($categories) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description != null ? $category->description : "-"}}</td>
                                    <td>
                                        <p>
                                        <a href="{{route('admin.expenses.categories.show', $category->id)}}" class="btn btn-info btn-sm">Expenses</a>
                                        <a href="{{route('admin.expenses.categories.edit', $category->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($category, ['method' => 'DELETE', 'action' => ['AdminExpenseCategoryController@destroy', $category->id]]) !!}
                                        {!! Form::hidden('', $category->id) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any Expense Categories!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
