<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     *确定当前用户只能编辑自己的个人信息
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
    */
    public function update(User $currentUser, User $user):bool
    {
        return $currentUser->id===$user->id;
    }

    /**
     * 确定当前用户是管理员才可以删除用户
     * 确定当前用户不能删除自己
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
    */
    public function destroy(User $currentUser, User $user):bool
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }

    /**
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function follow(User $currentUser, User $user):bool
    {
        return $currentUser->id!==$user->id;

    }
}
