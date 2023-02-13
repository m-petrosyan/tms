<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Requests\Task\TaskImgUpdateRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Resources\Task\TaskCollection;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Services\TaskService;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    protected TaskService $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return TaskCollection
     */
    public function index(): TaskCollection
    {
        return new TaskCollection(Task::paginate(15));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskCreateRequest  $request
     * @param  User  $user
     * @return Response|TaskResource
     */
    public function store(TaskCreateRequest $request, User $user): Response|TaskResource
    {
        return new TaskResource($this->taskService->store($request->validated(), $user));
    }

    /**
     * Display the specified resource.
     *
     * @param  Task  $task
     * @return TaskResource
     */
    public function show(Task $task): TaskResource
    {
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskUpdateRequest  $request
     * @param  Task  $task
     * @param  User  $user
     * @return Response
     */
    public function update(TaskUpdateRequest $request, Task $task, User $user): Response
    {
        $this->taskService->update($task, $user, $request->validated());

        return response()->noContent();
    }

    /**
     * @param  TaskImgUpdateRequest  $request
     * @param  Task  $task
     * @return Response
     */
    public function updateImg(TaskImgUpdateRequest $request, Task $task): Response
    {
        $this->taskService->updateImg($task, $request->img);

        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Task $task): Response
    {
        $task->delete();

        return response()->noContent();
    }
}
