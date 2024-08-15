@extends('layouts.default')
@section('title','更新密码')
@section('content')
    <div class="offset-md-1 col-md-10">
        <div class="card">
            <div class="card-header"><h5>更新密码</h5></div>
            <div class="card-body">
                <form action="{{route('passwords.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{$token}}">
                    <div class="mb-3 row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">email地址</label>
                        <div class="col-md-6">
                            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   type="email" name="email" id="email" value="{{ $email ?? old('email') }}"
                                   required autofocus>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-right" for="password">新的密码</label>
                        <div class="col-md-6">
                            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                type="password" name="password" id="password" value="{{old('password')}}" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-right" for="password_confirm">确认新的密码</label>
                        <div class="col-md-6">
                            <input class="form-control" type="password" name="password_confirm" id="password_confirm" required>
                        </div>
                    </div>
                    <div class="mb-3 row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">重置密码</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
