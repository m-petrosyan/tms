<?php

namespace App\Http\Controllers\Api;

use App\Enum\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskCreateRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Http\Resources\Task\TaskResource;
use App\Http\Resources\Task\TasksStatusCollection;
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
     * @return TasksStatusCollection
     */
    public function index(): TasksStatusCollection
    {
        return new TasksStatusCollection(StatusEnum::getValues());
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
