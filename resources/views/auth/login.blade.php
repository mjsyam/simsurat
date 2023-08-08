@extends('layouts.auth.app')

@section('content')
<h4 class="fw-300 c-grey-900 mB-40 py-5">Login</h4>
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group mb-5 {{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="text-dark form-label">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="form-text text-danger">
                <small>{{ $errors->first('email') }}</small>
            </span>
        @endif
    </div>

    <div class="form-group mb-5 {{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="text-dark form-labe">Password</label>
        <input id="password" type="password" class="form-control" name="password" required>

        @if ($errors->has('password'))
            <span class="form-text text-danger">
                <small>{{ $errors->first('password') }}</small>
            </span>
        @endif
    </div>

    <div class="form-group">
        <div class="peers ai-c jc-sb fxw-nw">
            <div class="peer">
                <button class="btn btn-primary">Login</button>
            </div>
        </div>
    </div>
</form>
@endsection
