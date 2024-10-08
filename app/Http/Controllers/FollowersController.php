<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @throws AuthorizationException
     */
    public function store(User $user): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('follow',$user);
        //如果没有关注
        if(!Auth::user()->isFollowing($user)){
            Auth::user()->follow($user->id);
        }
        return redirect()->route('users.show',$user->id);

    }

    /**
     * @throws AuthorizationException
     *
     */
    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        $this->authorize('follow', $user);
        if(Auth::user()->isFollowing($user->id)){
            Auth::user()->unfollow($user->id);
        }
        return redirect()->route('users.show',$user->id);


    }
}
