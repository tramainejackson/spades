@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12 col-lg-12 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
					<h2 class="text-center text-light">Login</h2>
				</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-6 control-label mx-auto d-block text-light">E-Mail Address</label>

                            <div class="col-md-6 mx-auto d-block">
								<div class="input-group">
									<span class="oi oi-person input-group-addon"></span>
									<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" style="border-top: solid 2px #e9ecef;" required autofocus>
								</div>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-6 control-label mx-auto d-block text-light">Password</label>

                            <div class="col-md-6 mx-auto d-block">
								<div class="input-group">
									<span class="oi oi-lock-locked input-group-addon"></span>
									<input id="password" type="password" class="form-control" name="password" style="border-top: solid 2px #e9ecef;" required>
								</div>

                                @if ($errors->has('password'))
                                    <span class="help-block">
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
