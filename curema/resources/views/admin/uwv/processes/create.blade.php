@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" class="style">
    <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" class="style">
@endsection
@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">UWV Process</div>
                    {!! Form::open(['method' => 'POST', 'action' => 'Addons\AdminUwvProcessController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('ordernr', 'Order number:') !!}
                        {!! Form::text('ordernr', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('client_id', 'Client:') !!}
                                {!! Form::select('client_id',$clients, null, ['class' => 'form-control selectpicker']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('contacts[]', 'UWV Contacts:') !!}
                                {!! Form::select('contacts[]',$contacts, null, ['class' => 'form-control selectpicker', 'multiple' => true]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::label('start_date', 'Assignment Date:') !!}
                                {!! Form::text('start_date', null, ['class' => 'form-control', 'id' => 'date']) !!}
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('end_date', 'Process Duration (months):') !!}
                                {!! Form::number('end_date', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('uwv_service_id', 'Service State:') !!}
                        {!! Form::select('uwv_service_id',$services, null, ['class' => 'form-control selectpicker']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Service', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/moment.min.js')}}"></script>
    <script src="{{asset('js/moment-locales.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

    {{-- Get DateTimePicker from Bootstrap --}}
    <script type="text/javascript">
        $(function () {
            $('#date').datetimepicker({
                format: 'YYYY/MM/DD'
            });
        });
    </script>
    @endsection