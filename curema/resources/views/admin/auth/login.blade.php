@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col col-md-offset-2">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-sign-in"></i> Login
                    </div>
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.login.submit') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>
                            <div class="form-check">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>

                            <div class="form-group">

                                    <button type="submit" class="col-md-12 btn btn-primary">
                                        Login
                                    </button>
                                    <div class="col"></div>
                                    <a class="btn btn-link col" href="{{ route('admin.password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                <div class="col"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
