<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends FileService
{
    /**
     * @param  array  $request
     * @return Model
     */
    public function register(array $request): Model
    {
        return User::query()->create([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);
    }

    public function update($request)
    {
        auth()->user()->update($request);
    }
}
