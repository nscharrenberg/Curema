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
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-building-o"></i> Departments
                        <a href="{{route('admin.departments.create')}}" class="btn btn-primary pull-right"> Create new Department</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($departments) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Color Codes</th>
                            <th>Agents</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($departments as $department)
                                <tr>
                                    <td>{{$department->name}}</td>
                                    <td><div class="colorbox" style="background-color: {{$department->color_code}}; height: 10px; width: 10px; display: inline-block"></div><span style="margin-left: 5px; vertical-align: middle">{{$department->color_code}}</span> </td>
                                    @if($department->agents != null)
                                        <td>{!! Form::select('agents', $department->agents->pluck('fullname', 'id'), null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}</td>
                                        @else
                                        <td>None</td>
                                        @endif
                                    <td>
                                        <a href="{{route('admin.departments.edit', $department->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>No departments found!</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
