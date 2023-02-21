<?php

namespace App\Http\Resources\Task;

use App\Models\Task;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class TasksResource extends JsonResource
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
            'title' => $this->status,
            'data' => new TaskCollection(Task::where('status', $this->status)->orderBy('index','asc')->get())
        ];
    }
}
