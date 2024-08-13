@extends('layouts.default')
@section('title','注册')
@section('content')
    <div class="offset-md-2 col-md-8">
        <div class="card ">

            <div class="card-header">
                <h5>注册</h5>
            </div>

            <div class="card-body">
                @include('shared/_errors')
                <form action="{{route('users.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label for="name">昵称：</label>
                        <input class="form-control" type="text" name="name" id="name" placeholder="请输入昵称" value="{{old('name')}}">
                    </div>
                    <div class="mb-3">
                        <label for="email">邮箱：</label>
                        <input class="form-control" type="text" name="email" id="email" placeholder="请输入邮箱" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password">密码：</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="请输入密码" value="{{old('password')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation">确认密码：</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="确认密码" value="{{old('password_confirmation')}}">
                    </div>

                    <button type="submit" class="btn btn-primary">注册</button>
                </form>
            </div>
        </div>
    </div>




@endsection
