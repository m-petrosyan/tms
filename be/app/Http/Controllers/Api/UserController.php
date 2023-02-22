<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserCreateRequest;
use App\Http\Requests\User\UserImgUpdateRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return UserResource
     */
    public function store(UserCreateRequest $request): UserResource
    {
        return new UserResource($this->userService->register($request->validated()));
    }

    /**
     * @return UserResource
     */
    public function auth(): UserResource
    {
        return new UserResource(auth()->user());
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @return Response
     */
    public function update(UserUpdateRequest $request): Response
    {
        $this->userService->update(array_filter($request->validated()));

        return response()->noContent();
    }

    /**
     * @param  UserImgUpdateRequest  $request
     * @return Response
     */
    public function updateImg(UserImgUpdateRequest $request): Response
    {
        $this->userService->updateImg(auth()->user(), $request->profile_pic, 'profile_pic', '/user');

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(): Response
    {
        auth()->user()->delete();

        return response()->noContent();
    }
}
