@extends('admin.invoices.create')

@section('invoice')
    <div class="form-group">
        {!! Form::label('test', 'test') !!}
        {!! Form::text('test', null, ['class' => 'form-control']) !!}
    </div>
    @endsection