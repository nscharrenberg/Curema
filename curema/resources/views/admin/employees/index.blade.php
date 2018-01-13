@extends('layouts.app')
@section('content')
    @if(Session::has('created_employee'))
        <div class="alert alert-success">
            <p>{{session('created_employee')}}</p>
        </div>
    @endif

    @if(Session::has('updated_employee'))
        <div class="alert alert-success">
            <p>{{session('updated_employee')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_employee'))
        <div class="alert alert-success">
            <p>{{session('deleted_employee')}}</p>
        </div>
    @endif


    @if(Session::has('admin_employee'))
        <div class="alert alert-danger">
            <p>{{session('admin_employee')}}</p>
        </div>
    @endif


    @if(Session::has('active_employee'))
        <div class="alert alert-danger">
            <p>{{session('active_employee')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <!-- Admin Overview -->
            <div class="col-md-12">

                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-secret"></i> Administrators
                        <a href="{{route('admin.employee.create')}}" class="btn btn-primary pull-right"> Create new Employee</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($admins) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Worker ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Departments</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{$admin->id}}</td>
                                    <td>{{$admin->fullname}}</td>
                                    <td>{{$admin->email}}</td>
                                    @if($admin->departments != null)
                                        <td>{!! Form::select('departments', $admin->departments->pluck('name', 'id'), null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $admin->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        @if(!$admin->active || !$admin->admin)
                                            {!! Form::model($admin, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $admin->id]]) !!}
                                            {!! Form::hidden('', $admin->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                            @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{$admins->render()}}
                    @else
                        <h3>No Administrators could be found!</h3>
                    @endif
                    </div>
                </div>
            </div>

            <!-- Agents Overview -->
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-secret"></i> Support Agent
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($agents) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Worker ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Departments</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($agents as $agent)
                                <tr>
                                    <td>{{$agent->id}}</td>
                                    <td>{{$agent->fullname}}</td>
                                    <td>{{$agent->email}}</td>
                                    @if($agent->departments != null)
                                        <td>{!! Form::select('departments', $agent->departments->pluck('name', 'id'), null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $agent->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        @if(!$agent->active || !$agent->admin)
                                            {!! Form::model($agent, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $agent->id]]) !!}
                                            {!! Form::hidden('', $agent->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{$agents->render()}}
                    @else
                        <h3>No Support Agents could be found!</h3>
                    @endif
                    </div>
                </div>
            </div>

            <!-- Employees Overview -->
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-secret"></i> Regular Employee
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($employees) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Worker ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Departments</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$employee->id}}</td>
                                    <td>{{$employee->fullname}}</td>
                                    <td>{{$employee->email}}</td>
                                    @if($employee->departments != null)
                                        <td>{!! Form::select('departments', $employee->departments->pluck('name', 'id'), null, ['class' => 'form-control select', 'data-live-search' => 'true']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $employee->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                        @if(!$admin->active || !$admin->admin)
                                            {!! Form::model($employee, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $employee->id]]) !!}
                                            {!! Form::hidden('', $employee->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{$employees->render()}}
                    @else
                        <h3>No Regular Employees could be found!</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection