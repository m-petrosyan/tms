<?php

namespace App\Observers;

use App\Helpers\General;
use App\Models\User;

class UserObserver
{
    /**
     * @param  User  $user
     * @return void
     */
    public function updating(User $user): void
    {
        if ($user->isDirty('profile_pic') && $user->getOriginal('profile_pic')){
            General::deleteFile($user->getOriginal('profile_pic'), 'user');
        }
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted(User $user): void
    {
        if ($user->profile_pic){
            General::deleteFile($user->profile_pic, 'user');
        }
    }
}
