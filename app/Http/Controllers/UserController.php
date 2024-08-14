<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{


public function __construct()
{
// 未登录的用户可以访问个人信息页面和注册页面
// 未登录用户访问用户编辑页面时将被重定向到登录页面
// 已经登录的用户才可以访问个人信息编辑页面
// except 方法来设定 指定动作 不使用 Auth 中间件进行过滤
// 这行代码的意思是，除了 index、show、create 和 store 这几个方法之外，所有其他的方法都会要求用户进行登录
// 换言之，用户在未登录的情况下，只能执行 index、show、create 和 store 这几个动作，其他动作都需要登录后才能访问
$this->middleware('auth', ['except' => ['index', 'show', 'create', 'store','confirmEmail']]);
//只让未登录用户访问注册页面
$this->middleware('guest', ['only' => ['create']]);

}

/**
* 定义index函数
*
*
*/
public function index(): Factory|View|Application
{
$users = User::paginate(10);
return view('users.index', compact('users'));
}

/**
* 定义create函数
*/
public function create(): Factory|View|Application
{

return view('users.create');
}

/**
* 定义store函数
* @throws ValidationException
*/
public function store(Request $request): RedirectResponse
{
$this->validate($request, [
'name' => 'required|unique:users|max:50',
'email' => 'required|email|unique:users|max:255',
'password' => 'required|min:6|confirmed',
]);
$user = User::create([
'name' => $request->name,
'email' => $request->email,
'password' => bcrypt($request->password)
]);
//新建的用户 根据填的邮箱  把/signup/confirm/$user->activation_token 连接发送到邮箱里面
$this->sendEmailConfirmationTo($user);
//Auth::login($user);
session()->flash('success', '验证邮件已经发送到你的注册邮箱上，请注意查收');
return redirect()->route('home');

//return redirect()->route('users.show', [$user]);

}

/**定义show函数
* */
public function show(User $user): Factory|View|Application
{
return view('users.show', compact('user'));
}

/**
* 定义edit函数
* @throws AuthorizationException
*/
public function edit(User $user): Factory|View|Application
{
//只有当前登录的用户为编辑用户时才能更新用户信息
//使用authorize方法来验证用户授权策略，如果不通过则会抛出403异常
$this->authorize('update', $user);
return view('users.edit', compact('user'));
}

/**
* 定义update函数
*
* @throws ValidationException
* @throws AuthorizationException
*/
public function update(User $user, Request $request): RedirectResponse
{   //只有当前登录的用户为编辑用户时才能更新用户信息
//使用authorize方法来验证用户授权策略，如果不通过则会抛出403异常
$this->authorize('update', $user);
$this->validate($request, [
'name' => 'required|max:50',
'password' => 'nullable|confirmed|min:6'
]);
$data = [];
$data['name'] = $request->get('name');
if ($request->get('password')) {
$data['password'] = bcrypt($request->get('password'));
}
$user->update($data);
session()->flash('success', '个人资料更新成功');
return redirect()->route('users.show', $user->id);
}


/**
* 定义删除函数
*
* @throws AuthorizationException
*/
public function destroy(User $user): RedirectResponse
{
$this->authorize('destroy', $user);
$user->delete();
session()->flash('success', '成功删除用户！');
return back();
}

public function confirmEmail($token):RedirectResponse
{
$user=User::where('activation_token', $token)->firstOrFail();
$user->activated=true;
$user->activation_token=null;
$user->save();

//Auth::login($user);
session()->flash('success','恭喜你，激活成功');
return redirect()->route('users.show', [$user]);

}

//新建的用户 根据填的邮箱  把/signup/confirm/$user->activation_token 连接发送到邮箱里面
public function sendEmailConfirmationTo($user): void
{
$view='emails.confirm';
$data=compact('user');
$from='2325287709@qq.com';
$to=$user->email;
$subject='感谢注册微博应用，请确认那您的邮箱';
Mail::send($view, $data, function ($message) use ($from,$to, $subject)
{
$message->from($from,'WeiboServer');
$message->to($to)->subject($subject);
});

}



}


