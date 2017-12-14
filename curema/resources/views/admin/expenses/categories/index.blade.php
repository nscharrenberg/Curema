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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.expenses.categories.create')}}" class="btn btn-primary"> New Exepnse Category</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Expense Categories
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($categories)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description != null ? $category->description : "-"}}</td>
                                    <td>
                                        <a href="{{route('admin.expenses.categories.show', $category->id)}}" class="btn btn-info btn-xs">Expenses</a>
                                        <a href="{{route('admin.expenses.categories.edit', $category->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($category, ['method' => 'DELETE', 'action' => ['AdminExpenseCategoryController@destroy', $category->id]]) !!}
                                        {!! Form::hidden('', $category->id) !!}
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
