<?php

namespace App\Http\Resources\Task;

use App\Repositories\TaskRepository;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TasksStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'status' => $this->resource,
            'data' => new TaskCollection(TaskRepository::getTasks($this->resource, $request->search)),
        ];
    }
}
