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
        $task = $user->taskAssigned()->create(
            Arr::only($request, ['title', 'description', 'status']) + [
                'assigned_to' => $user->id,
                'index' => -1,
            ]
        );

        if (isset($request['img'])) {
            $this->updateImg($task, $request['img'], 'img', '/task');
        }

        return $task;
    }

    /**
     * @param  object  $task
     * @param  object  $user
     * @param  array  $request
     * @return void
     */
    public function update(object $task, object $user, array $request): void
    {
        if (isset($request['img'])) {
            $this->updateImg($task, $request['img'], 'img', '/task');
        }

        $task->update(
            Arr::only($request, ['title', 'description', 'status', 'index']) + ['assigned_to' => $user->id]
        );
    }

}
