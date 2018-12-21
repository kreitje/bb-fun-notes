@extends('layouts.main')


@section('title', 'My Notes')


@section('content')

    <div class="login-form">
        <form method="POST" action="{{url('login')}}">
            {{csrf_field()}}

            @if (session()->has('loginError'))
                <div class="alert alert-danger">{{session()->get('loginError')}}</div>
            @endif

            <div class="form-group form-text mb-0 @if ($errors->has('email')) has-error @endif">
                <label for="email">Email Address</label>
                <input class="form-control @if ($errors->has('email')) is-invalid @endif" type="email" id="email" name="email" value="{{old('email', '')}}" placeholder="john@smith.com" tabindex="1" required />
                @if ($errors->has('email')) <div class="invalid-feedback">{{$errors->first('email')}}</div> @endif
            </div>

            <div class="form-group form-text @if ($errors->has('password')) has-error @endif">
                <label for="password">Password</label>
                <input class="form-control @if ($errors->has('email')) is-invalid @endif" type="password" id="password" name="password" tabindex="2" placeholder="password" required />
                @if ($errors->has('password'))  <div class="invalid-feedback">{{$errors->first('password')}}</div> @endif
            </div>

            <button class="btn btn-primary">Login</button>

        </form>

    </div>


@stop