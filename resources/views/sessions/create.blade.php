@extends('layouts.default')
@section('title','登录')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">
            <div class="card-header">
                <h5>登录</h5>
            </div>
            <div class="card-body">
                @include('shared._errors')

                <form action="{{route('login')}}" method="POST">
                    {{csrf_field()}}


                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <input class="form-control" type="text" name="email" id="email" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码（<a href="{{route('passwords.request')}}">忘记密码</a>）</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{old('password')}}">
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">记住我</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">登录</button>
                </form>
                <hr>
                <p>还没有账号?<a href="{{route('signup')}}">现在注册！</a></p>

            </div>
        </div>
    </div>
@stop
