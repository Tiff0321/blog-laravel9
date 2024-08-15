@extends('layouts.default')
@section('title','重置密码')
@section('content')
    <div class="col-md-8 offset-md-2">
        <div class="card ">
            <div class="card-header"><h5>重置密码</h5></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{route('passwords.email')}}" method="post">
                    {{csrf_field()}}
                    <div class="mb-3{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="form-control-label">邮箱</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{old('email')}}" required>
                        @if ($errors->has('email'))
                            <span class="form-text">
                              <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">发送密码重置邮件</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
