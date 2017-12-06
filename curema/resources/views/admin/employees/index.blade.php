@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" class="style">
@endsection
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

            <div class="coll-md-12 pull-right">
                <div class="panel-heading"><a href="{{route('admin.employee.create')}}" class="btn btn-primary"> New Employee</a></div>
            </div>

            <!-- Admin Overview -->
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Admins
                    </div>
                    @if(count($admins) > 0)
                    <table class="table table-hover">
                        <thead>
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
                                        <td>{!! Form::select('departments', $admin->departments->pluck('name', 'id'), null, ['class' => 'form-control selectpicker']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $admin->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        @if(!$admin->active || !$admin->admin)
                                            {!! Form::model($admin, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $admin->id]]) !!}
                                            {!! Form::hidden('', $admin->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
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

            <!-- Agents Overview -->
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Support Agents
                    </div>
                    @if(count($agents) > 0)
                    <table class="table table-hover">
                        <thead>
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
                                        <td>{!! Form::select('departments', $agent->departments->pluck('name', 'id'), null, ['class' => 'form-control selectpicker']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $agent->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        @if(!$agent->active || !$agent->admin)
                                            {!! Form::model($agent, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $agent->id]]) !!}
                                            {!! Form::hidden('', $agent->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
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

            <!-- Employees Overview -->
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Regular Employees
                    </div>
                    @if(count($employees) > 0)
                    <table class="table table-hover">
                        <thead>
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
                                        <td>{!! Form::select('departments', $employee->departments->pluck('name', 'id'), null, ['class' => 'form-control selectpicker']) !!}</td>
                                    @else
                                        <td>None</td>
                                    @endif

                                    <td>
                                        <a href="{{route('admin.employee.edit', $employee->id)}}" class="btn btn-warning btn-xs">Edit</a>
                                        @if(!$admin->active || !$admin->admin)
                                            {!! Form::model($employee, ['method' => 'DELETE', 'action' => ['AdminEmployeeController@destroy', $employee->id]]) !!}
                                            {!! Form::hidden('', $employee->id) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
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
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>
@endsection