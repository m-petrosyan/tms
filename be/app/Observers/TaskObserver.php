<?php

namespace App\Observers;

use App\Helpers\General;
use App\Models\Task;
use App\Services\FileService;

class TaskObserver extends FileService
{
    /**
     * Handle the Task "creating" event.
     *
     * @param  Task  $task
     * @return void
     */
    public function creating(Task $task): void
    {
        $task->created_by = auth()->id() ?? $task->created_by;
    }

    public function created(Task $task): void
    {
        $this->checkChangeFile($task, 'img', 'task');
    }

    /**
     * @param  Task  $task
     * @return void
     */
    public function updating(Task $task): void
    {
        $this->checkChangeFile($task, 'img', 'task');
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param  Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param  Task  $task
     * @return void
     */
    public function deleted(Task $task): void
    {
        if ($task->img) {
            General::deleteFile($task->img, 'task');
        }
    }
}
