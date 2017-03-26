@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body text-center" style="font-size: 40px;">
                    <center>
                        <div class="user user-color user-fa-3" style="font-size: 50px;">
                            <span class="fa fa-users fa-1x"></span>
                        </div>
                    </center>
                    {{ trans('auth.login') }}
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">{{ trans('auth.user') }}</label>
                                <input id="email" type="text" placeholder="{{ trans('auth.user') }}" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">{{ trans('auth.password') }}</label>
                                <input id="password" type="password" placeholder="{{ trans('auth.password') }}" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    <i class="fa fa-btn fa-sign-in"></i> {{ trans('auth.login') }}
                                </button>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <a href="{{ url('/password/reset') }}">{{ trans('auth.forgot_password') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
