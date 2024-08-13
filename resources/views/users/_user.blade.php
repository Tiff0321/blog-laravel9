<div class="list-group-item">
    <img width="32" class="mr-3" src="" alt="{{$user->name}}">
    <a href="{{route('users.show',$user)}}">{{$user->name}}</a>
    {{-- if 当前用户 == 管理员 && 当前用户 !== 要被删除的用户 --}}
    {{-- 显示删除按钮 --}}
    {{-- 伪代码，帮助我们整理思路，实际代码在下面 --}}
    @can('destroy',$user)
        <form action="{{route('users.destroy',$user->id)}}" method="post" class="float-end">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-sm btn-danger delete-btn">删除</button>
        </form>
    @endcan


</div>
