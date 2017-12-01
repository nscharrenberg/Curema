@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{asset('css/bootstrap.colorpickersliders.css')}}" class="style">
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
                    <div class="panel-heading">Lead Status</div>
                    {!! Form::open(['method' => 'POST', 'action' => 'AdminTicketPriorityController@store']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('color_code', 'Color:') !!}
                        {!! Form::text('color_code', null, ['class' => 'form-control', 'id' => 'color_code', 'value' => '#FFFFF', 'data-color-format' => 'hex']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Create Lead Status', ['class' => 'btn btn-primary']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/tinycolor-min.js')}}"></script>
    <script src="{{asset('js/bootstrap.colorpickersliders.js')}}"></script>
    <script src="{{asset('js/bootstrap.colorpickersliders.nocielch.js')}}"></script>

    <script>
        $("input#color_code").ColorPickerSliders({
            size: 'lg',
            placement: 'bottom',
            swatches: false,
            sliders: false,
            hsvpanel: true,
            previewformat: 'hex',
            invalidcolorsopacity: true,
            color: '#ffffff',
            order: {
                hex: 1
            }
        });
    </script>
@endsection


