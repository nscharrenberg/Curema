@extends('layouts.app')

@section('content')
    @if(Session::has('created_department'))
        <div class="alert alert-success">
            <p>{{session('created_department')}}</p>
        </div>
    @endif

    @if(Session::has('updated_department'))
        <div class="alert alert-success">
            <p>{{session('updated_department')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_department'))
        <div class="alert alert-success">
            <p>{{session('deleted_department')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.departments.create')}}" class="btn btn-primary"> New Department</a></div>
            </div>
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Departments
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Color Codes</th>
                            <th>Agents</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($departments)
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$department->name}}</td>
                                    <td><div class="colorbox" style="background-color: {{$department->color_code}}; height: 10px; width: 10px; display: inline-block"></div><span style="margin-left: 5px; vertical-align: middle">{{$department->color_code}}</span> </td>
                                    @if($department->agents != null)
                                        <td>{!! Form::select('agents', $department->agents->pluck('fullname', 'id'), null, ['class' => 'form-control']) !!}</td>
                                        @else
                                        <td>None</td>
                                        @endif
                                    <td>
                                        <a href="{{route('admin.departments.edit', $department->id)}}" class="btn btn-warning btn-xs">Edit</a>
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
