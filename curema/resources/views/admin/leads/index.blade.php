@extends('layouts.app')

@section('content')
    @if(Session::has('created_lead'))
        <div class="alert alert-success">
            <p>{{session('created_lead')}}</p>
        </div>
    @endif

    @if(Session::has('updated_lead'))
        <div class="alert alert-success">
            <p>{{session('updated_lead')}}</p>
        </div>
    @endif

    @if(Session::has('deleted_lead'))
        <div class="alert alert-success">
            <p>{{session('deleted_lead')}}</p>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-user-o"></i> Leads
                        <a href="{{route('admin.leads.create')}}" class="btn btn-primary pull-right"> Create new Lead</a>
                    </div>
                    <div class="card-body card-fullwidth">
                    @if(count($leads) > 0)
                    <table class="table table-hover">
                        <thead class="thead-primary">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($leads as $lead)
                                <tr>
                                    <td>{{$lead->name}}</td>
                                    <td>{{$lead->email}}</td>
                                    <td>{{$lead->company}}</td>
                                    <td>
                                        <a href="{{route('admin.leads.edit', $lead->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                        @else
                        <h3>Could not find any leads!</h3>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
