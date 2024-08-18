<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class StatusesController extends Controller
{
    /**
     *
     */
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //1.验证数据
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        //2.创建微博
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        //3.返回提示消息，并且重定向到对应的页面
        session()->flash('success','发布成功');
        return redirect()->back();
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Status $status): RedirectResponse
    {
        // 1. 授权检查
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博已被成功删除！');
        return redirect()->back();

    }
}
