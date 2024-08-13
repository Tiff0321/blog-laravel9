@extends('layouts.default')
@section('tittle','更新个人资料')
@section('content')
    <div>
        <div>
            <div>
                <h5>更新个人资料</h5>
            </div>
            <div>
                @include('shared._errors')
                <div>
                    <a href="https://gravatar.com/emails" target="_blank">
                        <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" class="gravatar"/>
                    </a>
                </div>

                <form action="{{route('users.update',$user->id)}}" method="post">
                    {{method_field('PATCH')}}
                    {{csrf_field()}}

                    <div>
                        <label for="name">昵称</label>
                        <input type="text" name="name" id="name" value="{{$user->name}}">
                    </div>
                    <div>
                        <label for="email">邮箱</label>
                        <input disabled type="text" name="email" id="email" value="{{$user->email}}">
                    </div>
                    <div>
                        <label for="password">密码</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}">
                    </div>
                    <div>
                        <label for="password_confirmation">确认密码</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}">
                    </div>
                    <button type="submit">更新</button>
                </form>
            </div>
        </div>
    </div>





@endsection
