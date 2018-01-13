@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-md-offset-2">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-sign-in"></i> Forgot Password
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('admin.password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group">
                                    <button type="submit" class="col-md-12 btn btn-primary">
                                        Send Password Reset Link
                                    </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
