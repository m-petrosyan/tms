<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    /**
     * @param  int  $status
     * @param  string|null  $search
     * @return mixed
     */
    public static function getTasks(int $status, string|null $search): mixed
    {
        return Task::where('status', $status)->where('title', 'LIKE', "%$search%")->orderBy(
            'index',
            'asc'
        )->get();
    }
}
