@extends('layouts.app')

@section('content')
<div class="container fullHeight">
    <div class="row fullHeight">
        <div class="col-12 fullHeight">
            <div class="panel panel-default d-flex align-items-stretch justify-content-center flex-column fullHeight">

                <div class="panel-body">
					<div class="panel-heading">
						<h2 class="text-center text-light mb-4">Login</h2>
					</div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label mx-auto d-block text-light">E-Mail Address</label>

                            <div class="col-md-6 mx-auto d-block">
								<div class="input-group" style="border: inset 1px darkgray; border-radius: 6px;">
									<span class="oi oi-person input-group-addon" style="border: none; background-color: #fff;"></span>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="margin: 0; border: none; background-color: #fff;" required autofocus>
								</div>

                                @if ($errors->has('email'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label mx-auto d-block text-light">Password</label>

                            <div class="col-md-6 mx-auto d-block">
								<div class="input-group" style="border: inset 1px darkgray; border-radius: 6px;">
									<span class="oi oi-lock-locked input-group-addon" style="border: none; background-color: #fff;"></span>
									<input id="password" type="password" class="form-control" name="password"  style="margin: 0; border: none; background-color: #fff;" required>
								</div>

                                @if ($errors->has('password'))
                                    <span class="help-block text-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 mx-auto d-block">
                                <div class="checkbox">
                                    <label class="text-light">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 mx-auto d-block">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
