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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.tax.create')}}" class="btn btn-primary"> New Tax</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Taxes
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Rate</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($taxes)
                            @foreach($taxes as $tax)
                                <tr>
                                    <td>{{$tax->name}}</td>
                                    <td>{{$tax->rate}}</td>
                                    <td>
                                        <a href="{{route('admin.tax.edit', $tax->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        {!! Form::model($tax, ['method' => 'DELETE', 'action' => ['AdminTaxController@destroy', $tax->id]]) !!}
                                            {!! Form::hidden('', $tax->id) !!}
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
