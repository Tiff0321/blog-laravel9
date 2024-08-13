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
    //create用户登录
    public function create():Factory|View|Application
    {
        return view('sessions.create');
    }
    //store

    /**
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
            //登陆成功
            session()->reflash('success','欢迎回来');
            return redirect()->route('users.show', [Auth::user()]);
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
