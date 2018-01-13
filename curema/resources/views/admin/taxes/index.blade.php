@extends('layouts.app')

@section('content')
    @if(Session::has('created_tax'))
        <div class="alert alert-success">
            <p>{{session('created_tax')}}</p>
        </div>
    @endif

    @if(Session::has('updated_tax'))
        <div class="alert alert-success">
            <p>{{session('updated_tax')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_tax'))
        <div class="alert alert-success">
            <p>{{session('deleted_tax')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-percent"></i> Taxes
                        <a href="{{route('admin.tax.create')}}" class="btn btn-primary pull-right"> Create new Tax</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($taxes) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Rate</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($taxes as $tax)
                                <tr>
                                    <td>{{$tax->name}}</td>
                                    <td>{{$tax->rate}}</td>
                                    <td>
                                        <a href="{{route('admin.tax.edit', $tax->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        {!! Form::model($tax, ['method' => 'DELETE', 'action' => ['AdminTaxController@destroy', $tax->id]]) !!}
                                            {!! Form::hidden('', $tax->id) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any Tax!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
