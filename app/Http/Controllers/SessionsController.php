<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\logicalNot;

class SessionsController extends Controller
{
    /**
     * 用户登录step1
     *
     * @return Factory|View|Application
     *
     */
    public function create():Factory|View|Application
    {
        return view('sessions.create');
    }
    /**
     * 用户登录step2
     *
     * @throws ValidationException
     */

    public function store(Request $request): RedirectResponse
    {
        $credential = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        // Laravel 中 Auth 的 attempt 方法可以让我们很方便的完成用户的身份认证操作
        if (Auth::attempt($credential,$request->has('remember'))) {
            if (Auth::user()->activated){
                //登录成功
                session()->reflash('success','欢迎回来');
                $fallback=route('users.show',Auth::user());
                // intended 方法可将页面重定向到上一次请求尝试访问的页面上
                // 如果上一次请求记录为空，则跳转到默认地址, 这里是用户个人页面
                return redirect()->intended($fallback);
            }else{
                Auth::logout();
                session()->flash('warning', '您的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
            //登陆成功
            //session()->reflash('success','欢迎回来');
            //return redirect()->route('users.show', [Auth::user()]);
        } else{
            //登陆失败
            session()->flash('danger', '抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
        }

    }

    //destroy
    public function destroy():RedirectResponse
    {
        Auth::logout();
        session()->flash('success','您已退出登录');
        return redirect('login');
    }
}
