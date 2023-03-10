<?php

namespace App\Services;

use Illuminate\Support\Arr;

class TaskService extends FileService
{
    /**
     * @param  array  $request
     * @param  object  $user
     * @return mixed
     */
    public function store(array $request, object $user): mixed
    {
        return $user->taskAssigned()->create(
            Arr::only($request, ['title', 'img', 'description', 'status']) + ['assigned_to' => $user->id, 'index' => -1]
        );
    }

    /**
     * @param  object  $task
     * @param  object  $user
     * @param  array  $request
     * @return void
     */
    public function update(object $task, object $user, array $request): void
    {
        $task->update(
            Arr::only($request, ['title', 'img', 'description', 'status', 'index']) + ['assigned_to' => $user->id]
        );
    }
}
